<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public $table = 'campaigns';

    protected $fillable = [
        'name',
        'channel',
        'tags_ids',
        'country_ids',
        'exclusion_ids',
        'server_ids',
        'template',
        'scheduled_at',
        'completed_at',
    ];
}
