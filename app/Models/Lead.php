<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    public $table = 'leads';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'origin',
        'tag_ids'
    ];
}
