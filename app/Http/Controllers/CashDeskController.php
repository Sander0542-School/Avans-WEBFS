<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderDish;
use Inertia\Inertia;

class CashDeskController extends Controller
{
    public function index()
    {
        return Inertia::render('CashDesk/Index');
    }

    public function dishes()
    {
        return Inertia::render('CashDesk/Dishes', [
            'menu' => MenuCategory::menuData(),
            'dishes' => Dish::cartData(),
        ]);
    }
}
