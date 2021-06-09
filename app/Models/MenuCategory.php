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

    public static function menuData()
    {
        return self::all()->map(function (MenuCategory $category) {
            return [
                'name' => $category->name,
                'extra_option' => $category->extra_option,
                'dishes' => $category->dishes->map(function (Dish $dish) {
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
                }),
            ];
        });
    }
}
