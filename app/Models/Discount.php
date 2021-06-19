<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $casts = [
        'valid_until' => 'datetime',
    ];

    protected $fillable = [
        'dish_id',
        'name',
        'discount',
        'valid_until',
    ];

    public function dishes()
    {
        return $this->hasManyThrough(Dish::class, DishDiscount::class, 'discount_id', 'id', 'id', 'dish_id');
    }

    public static function whereActive()
    {
        return self::where('valid_until', '>=', now());
    }
}
