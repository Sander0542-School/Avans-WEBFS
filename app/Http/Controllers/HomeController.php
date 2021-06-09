<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Models\Dish;
use App\Models\MenuCategory;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Index');
    }

    public function menu()
    {
        return Inertia::render('Home/Menu', [
            'menu' => MenuCategory::all()->map(function (MenuCategory $category) {
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
            }),
        ]);
    }

    public function contact()
    {
        return Inertia::render('Home/Contact');
    }

    public function news()
    {
        return Inertia::render('Home/News');
    }

    public function discounts()
    {
        return Inertia::render('Home/Discounts');
    }
}
