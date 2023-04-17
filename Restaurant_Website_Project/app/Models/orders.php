<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class orders extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'orders';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'Status',
        'Shipping',
        'Quantity',
        'product_id',
        'user_id',
        'Total',
    ];
}
