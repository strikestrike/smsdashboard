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
        'target_countries',
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

    public function exclusions()
    {
        return $this->belongsToMany(Exclusion::class, 'campaign_exclusion');
    }

    public function sendingServers()
    {
        return $this->belongsToMany(SendingServer::class, 'campaign_server');
    }
}
