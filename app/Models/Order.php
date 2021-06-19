<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'table_number',
        'status',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
    ];

    public function lines()
    {
        return $this->hasMany(OrderDish::class, 'order_id', 'id')->with('dish');
    }

    public function dishes()
    {
        return $this->hasManyThrough(Dish::class, OrderDish::class, 'order_id', 'id', 'id', 'dish_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getPriceAttribute()
    {
        return $this->lines->sum('price');
    }

    public function getPriceIncAttribute()
    {
        return $this->lines->sum('price_inc');
    }
}
