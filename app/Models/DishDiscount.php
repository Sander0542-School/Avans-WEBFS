<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DishDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'dish_id',
        'discount_id',
    ];

    public function dish()
    {
        return $this->hasOne(Dish::class, 'id', 'dish_id');
    }

    public function discount()
    {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }
}
