<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Models\Dish;
use App\Models\MenuCategory;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        return Inertia::render('Order/Index', [
            'menu' => MenuCategory::all()->map(function (MenuCategory $category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'extra_option' => $category->extra_option,
                ];
            }),
        ]);
    }

    public function show(MenuCategory $category)
    {
        return Inertia::render('Order/Show', [
            'category' => [
                'id' => $category->id,
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
            ],
        ]);
    }
}
