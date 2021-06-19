<?php

namespace App\Http\Controllers;

use App\Models\Discount;
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
            'menu' => MenuCategory::menuData(),
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
        return Inertia::render('Home/Discounts', [
            'discounts' => Discount::whereActive()->with('dishes')->get()->map(fn(Discount $discount) => [
                'name' => $discount->name,
                'discount' => $discount->discount,
                'valid_until' => $discount->valid_until,
                'dishes' => $discount->dishes->map(fn(Dish $dish) => [
                    'id' => $dish->id,
                    'number' => $dish->number,
                    'addition' => $dish->addition,
                    'name' => $dish->name,
                    'base_price' => $dish->base_price_inc,
                    'price' => $dish->price_inc,
                ]),
            ]),
        ]);
    }
}
