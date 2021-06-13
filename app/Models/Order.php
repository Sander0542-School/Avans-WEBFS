<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'table_number',
    ];

    public function lines()
    {
        return $this->hasMany(OrderDish::class, 'order_id', 'id')->with('dish');
    }

    public function dishes()
    {
        return $this->hasManyThrough(Dish::class, OrderDish::class, 'order_id', 'id', 'id', 'dish_id');
    }

    public function getPriceAttribute()
    {
        return $this->dishes->sum('price');
    }

    public function getPriceIncAttribute()
    {
        return $this->dishes->sum('price_inc');
    }
}
