<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashDesk\StoreRequest;
use App\Models\Dish;
use App\Models\MenuCategory;
use App\Models\Order;
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
                'unit_price' => $dish->getPriceIncAttribute(),
                'remark' => $line['remark'],
            ];
        }));

        return redirect()->back()->with('message', 'Order succesvol aangemaakt.');
    }
}
