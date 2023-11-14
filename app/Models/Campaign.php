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
        // Step 1: Get all tags of the campaign
        $campaignTags = $this->tags;

        // Step 2: Get all leads associated with these tags
        $leads = Lead::whereHas('tags', function ($query) use ($campaignTags) {
            $query->whereIn('tag_id', $campaignTags->pluck('id'));
        })->get();

        // Step 3: Filter leads whose campaigns contain the current campaign
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
