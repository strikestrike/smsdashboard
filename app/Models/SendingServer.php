<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SendingServer extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'sending_servers';

    protected $fillable = [
        'name',
        'product_token',
        'api_key',
        'api_endpoint',
        'phone_number',
        'limits'
    ];

    public function exclusions()
    {
        return $this->hasMany(Exclusion::class, 'sending_server_id');
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_server', 'sending_server_id', 'campaign_id');
    }

    public function excludedLeads()
    {
        return $this->belongsToMany(Lead::class, 'exclusions', 'sending_server_id', 'lead_number', 'id', 'phone');
    }
}
