<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\CashDesk\StoreRequest;
use App\Models\Dish;
use App\Models\DishRiceOption;
use App\Models\MenuCategory;
use App\Models\Order;
use Inertia\Inertia;

class CashDeskController extends Controller
{
    public function index()
    {
        return Inertia::render('Manager/CashDesk/Index');
    }

    public function dishes()
    {
        return Inertia::render('Manager/CashDesk/Dishes', [
            'menu' => MenuCategory::menuData(),
            'dish_rice_options' => DishRiceOption::all(),
            'dishes' => Dish::cartData(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $order = Order::create([
            'user_id' => $request->user()->id ?? null,
            'table_number' => null,
        ]);

        $order->lines()->createMany(collect($data['cart'])->map(function ($line) {
            $dish = Dish::findOrFail($line['id']);

            return [
                'dish_id' => $dish->id,
                'amount' => $line['quantity'],
                'unit_price' => $dish->price,
                'remark' => $line['remark'],
                'rice_option_id' => $line['dish_rice_option'] != "" ? $line['dish_rice_option'] : null,
            ];
        }));

        return redirect()->back()->with('message', 'Order succesvol aangemaakt.');
    }
}
