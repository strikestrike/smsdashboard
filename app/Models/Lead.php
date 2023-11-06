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

    public function smslogs()
    {
        return $this->belongsToMany(Tag::class, 'lead_tag');
    }

    public function excludedServers()
    {
        return $this->belongsToMany(SendingServer::class, 'exclusions', 'lead_number', 'sending_server_id', 'phone', 'id');
    }

    public function unsubscribedCampaigns()
    {
        return $this->belongsToMany(Campaign::class, 'exclusions', 'lead_number', 'campaign_id', 'phone', 'id');
    }

    public function campaigns()
    {
        $leadPhone = $this->phone; // Get the lead's phone number

        return Campaign::whereHas('tags', function ($query) {
            $query->whereIn('tag_id', $this->tags->pluck('id'));
        })->whereHas('sendingServers', function ($query) use ($leadPhone) {
            $query->whereDoesntHave('exclusions', function ($innerQuery) use ($leadPhone) {
                $innerQuery->where('lead_number', $leadPhone);
            });
        })->has('sendingServers', '>=', 1);
    }

    public function campaignsWithSMSHistory()
    {
        return $this->belongsToMany(Campaign::class, 'sms_logs', 'lead_id', 'campaign_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function scopeLeadsWithSuccessfulSMSHistory($query)
    {
        return $query->whereHas('campaignsWithSMSHistory', function ($subquery) {
            $subquery->where('status', 'sent');
        });
    }
}
