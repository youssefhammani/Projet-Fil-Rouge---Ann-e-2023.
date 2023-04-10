<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';


    protected $fillable = [
        'category',
        'user_id',
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Plant::class);
    }
}
