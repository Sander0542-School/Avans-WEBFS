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

    public function orders()
    {
        return Inertia::render('CashDesk/Orders', [
            'orders' => Order::with('lines')->orderByDesc('created_at')->paginate()->through(function (Order $order) {
                return [
                    'id' => $order->id,
                    'price' => $order->price,
                    'seller' => $order->user->name ?? 'Customer',
                    'items' => $order->lines->count(),
                    'created_at' => $order->created_at,
                ];
            }),
        ]);
    }

    public function orders_show(Order $order)
    {
        return Inertia::render('CashDesk/Orders/Show', [
            'order' => [
                'id' => $order->id,
                'seller' => $order->user->name ?? 'Customer',
                'price' => $order->price,
                'price_inc' => $order->price_inc,
                'created_at' => $order->created_at,
                'dishes' => $order->lines()->with('dish')->get()->map(function (OrderDish $line) {
                    return [
                        'number' => $line->dish->number,
                        'addition' => $line->dish->addition,
                        'name' => $line->dish->name,
                        'price' => $line->unit_price,
                        'price_inc' => $line->unit_price_inc,
                        'btw' => $line->btw,
                        'amount' => $line->amount,
                    ];
                }),
            ],
        ]);
    }
}
