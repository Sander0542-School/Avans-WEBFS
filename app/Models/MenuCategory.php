<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'extra_option',
    ];

    protected $casts = [
        'extra_option' => 'boolean',
    ];

    public function dishes()
    {
        return $this->hasMany(Dish::class, 'category_id', 'id');
    }

    public function menuDishes()
    {
        return $this->dishes->map(function (Dish $dish) {
            return [
                'id' => $dish->id,
                'number' => $dish->number,
                'addition' => $dish->addition,
                'name' => $dish->name,
                'description' => $dish->description,
                'price' => $dish->price_inc,
                'spiciness' => $dish->spiciness_level ?? 0,
                'allergies' => $dish->allergies->map(function (Allergy $allergy) {
                    return [
                        'name' => $allergy->name,
                        'icon' => $allergy->icon,
                    ];
                }),
            ];
        });
    }

    public static function menuData($withDishes = true)
    {
        $dishes = ($withDishes ? self::with('dishes')->get() : self::all());

        return $dishes->map(function (MenuCategory $category) use ($withDishes) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'extra_option' => $category->extra_option,
                'dishes' => $withDishes ? $category->menuDishes() : null,
            ];
        })->except($withDishes ? [] : ['dishes']);
    }
}
