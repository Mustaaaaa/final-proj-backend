<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_address',
        'customer_phone',
        'customer_email',
        'details',
        'total',
        'created_at',

    ];

    public function dishes()
    {
        return $this->belongsToMany(Dish::class, 'dish_order')->withPivot('qty');
    }
}
