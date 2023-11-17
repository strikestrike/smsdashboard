<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'campaigns';

    protected $dates = [
        'scheduled_at',
        'completed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'channel',
        'template',
        'scheduled_at',
        'completed_at',
    ];

    // Event to set default value for scheduled_at when creating a new record
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->scheduled_at) {
                $model->scheduled_at = now()->startOfMinute();
            }
        });
    }

    // Event to set default value for scheduled_at when updating a record
    public static function updating($model)
    {
        if (!$model->scheduled_at) {
            $model->scheduled_at = now()->startOfMinute();
        }
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'campaign_tag');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'campaign_country');
    }

    public function exclusions()
    {
        return $this->belongsToMany(SendingServer::class, 'campaign_exclusion');
    }

    public function sendingServers()
    {
        return $this->belongsToMany(SendingServer::class, 'campaign_server');
    }

    public function scopeOngoingCampaigns($query)
    {
        return $query->whereNull('completed_at');
    }

    public function scopeUnsubscribedCampaigns($query)
    {
        return $this->hasMany(Exclusion::class, 'campaign_id')
                    ->selectRaw('COUNT(*) as campaign_count')
                    ->groupBy('campaign_id')
                    ->havingRaw('COUNT(*) > 1');
    }

    public function unsubscribedLeads()
    {
        return $this->belongsToMany(Lead::class, 'exclusions', 'campaign_id', 'lead_number', 'id', 'phone');
    }

    public function associatedLeads()
    {
        $campaignTags = $this->tags;
        $campaignCountries = $this->countries;

        $qb = Lead::query();
        if (count($campaignTags) > 0) {
            $qb = $qb->whereHas('tags', function ($query) use ($campaignTags) {
                $query->whereIn('tag_id', $campaignTags->pluck('id'));
            });
        }
        if (count($campaignCountries) > 0) {
            $qb = $qb->whereHas('country', function ($query) use ($campaignCountries) {
                $query->whereIn('origin', $campaignCountries->pluck('id'));
            });
        }

        // Get the list of blacklisted phone numbers
        $blacklistedPhoneNumbers = BlackList::pluck('phone_number')->toArray();

        // Exclude leads with blacklisted phone numbers
        $qb->whereNotIn('phone', $blacklistedPhoneNumbers);

        $leads = $qb->get();

        // Filter leads whose campaigns contain the current campaign
        $filteredLeads = $leads->filter(function ($lead) {
            // Check campaign conditions manually
            $leadCampaigns = $lead->campaigns()->get();

            // Replace this condition with your specific campaign matching logic
            $containsCampaign = $leadCampaigns->contains(function ($campaign) {
                return $campaign->id === $this->id;
            });

            return $containsCampaign;
        });

        return $filteredLeads;
    }

}
