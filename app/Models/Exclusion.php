<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Exclusion extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'exclusions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'lead_number',
        'sending_server_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function leads()
    {
        return $this->belongsToMany(Lead::class, 'lead_exclusion');
    }
}
