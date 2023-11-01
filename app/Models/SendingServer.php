<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendingServer extends Model
{
    use HasFactory;

    protected $table = 'sending_servers';

    protected $fillable = [
        'name',
        'sender_number',
        'sender_api'
    ];

    public function exclusions()
    {
        return $this->hasMany(Exclusion::class, 'sending_server_id');
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_server', 'sending_server_id', 'campaign_id');
    }
}
