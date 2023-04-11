<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'user_id',
        'category_id',
        // '_token', // add _token to the fillable array
    ];

    protected $attributes = [
        'image_url' => 'default-image.jpg',
    ];    

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
