<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'title',
        'description',
        'event_time',
        'start_time',
        'end_time',
        'num_of_people',
        'event_image',
        'price',
        'user_id',
    ];
}
