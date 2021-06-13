<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\MenuCategory;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        return Inertia::render('Order/Index', [
            'menu' => MenuCategory::menuData(false),
            'dishes' => Dish::cartData(),
        ]);
    }

    public function show(MenuCategory $category)
    {
        return Inertia::render('Order/Show', [
            'category' => [
                'id' => $category->id,
                'name' => $category->name,
                'extra_option' => $category->extra_option,
                'dishes' => $category->menuDishes(),
            ],
        ]);
    }
}
