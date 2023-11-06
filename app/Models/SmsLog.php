<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class SmsLog extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'sms_logs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeReceivedSMSLogs($query)
    {
        return $query->where('type', 'in');
    }

    public function scopeSentSMSLogs($query)
    {
        return $query->where('type', 'out');
    }
}
