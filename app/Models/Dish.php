<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'number',
        'addition',
        'name',
        'description',
        'base_price',
        'btw',
        'spiciness_level',
    ];

    protected $casts = [
        'base_price' => 'double',
    ];

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }

    public function dish_allergies()
    {
        return $this->hasMany(DishAllergy::class, 'dish_id', 'id');
    }

    public function allergies()
    {
        return $this->hasManyThrough(Allergy::class, DishAllergy::class, 'dish_id', 'id', 'id', 'allergy_id');
    }

    public function category()
    {
        return $this->hasOne(MenuCategory::class, 'id', 'category_id ');
    }

    public function discounts()
    {
        return $this->hasManyThrough(Discount::class, DishDiscount::class, 'dish_id', 'id', 'id', 'discount_id');
    }

    public function getPriceAttribute()
    {
        $discount = $this->discounts()->whereDate('valid_until', '>=', now())->orderByDesc('discount')->first();

        if ($discount != null) {
            return ((100 - $discount->discount) / 100) * $this->base_price;
        }

        return $this->base_price;
    }

    public function getPriceIncAttribute()
    {
        return (($this->btw + 100) / 100) * $this->price;
    }

    public function getBasePriceIncAttribute()
    {
        return (($this->btw + 100) / 100) * $this->base_price;
    }

    public static function cartData()
    {
        return self::all()->map(function (self $dish) {
            return [
                'id' => $dish->id,
                'number' => $dish->number,
                'addition' => $dish->addition,
                'name' => $dish->name,
                'base_price' => $dish->base_price,
                'base_price_inc' => $dish->base_price_inc,
                'price' => $dish->price,
                'price_inc' => $dish->price_inc,
            ];
        });
    }
}
