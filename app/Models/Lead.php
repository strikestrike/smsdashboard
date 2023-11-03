<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Lead extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'leads';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'origin'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'origin');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'lead_tag');
    }

    public function excludedServers()
    {
        return SendingServer::whereHas('exclusions', function ($query) {
            $query->where('lead_number', $this->phone);
        });
    }

    public function campaigns()
    {
        $leadPhone = $this->phone; // Get the lead's phone number

        $exclusionIds = Exclusion::where('lead_number', $leadPhone)->pluck('id')->toArray();

        return Campaign::whereHas('tags', function ($query) {
            $query->whereIn('tag_id', $this->tags->pluck('id'));
        })
        ->whereDoesntHave('exclusions', function ($query) use ($exclusionIds) {
            $query->whereIn('exclusions.id', $exclusionIds);
        })
        ->whereDoesntHave('sendingServers.exclusions', function ($query) use ($exclusionIds) {
            $query->whereIn('exclusions.id', $exclusionIds);
        });
    }

    public function ongoingCampaigns()
    {
        return $this->campaigns()
            ->whereNotNull('scheduled_at') // Ensure a campaign has a scheduled date
            ->whereNull('completed_at') // The campaign should not be completed
            ->where('scheduled_at', '<=', now()); // Campaign scheduled to be sent before or at the current time
    }

    public function excludedCampaigns()
    {
        $leadPhone = $this->phone;

        $exclusionIds = Exclusion::where('lead_number', $leadPhone)->pluck('id')->toArray();

        return Campaign::whereHas('sendingServers.exclusions', function ($query) use ($exclusionIds) {
            $query->whereIn('exclusions.id', $exclusionIds);
        })
        ->orWhereHas('exclusions', function ($query) use ($exclusionIds) {
            $query->whereIn('exclusions.id', $exclusionIds);
        });
    }
}
