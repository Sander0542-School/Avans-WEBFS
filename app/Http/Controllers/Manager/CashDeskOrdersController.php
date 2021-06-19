<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\CashDeskOrders\StatusRequest;
use App\Models\Order;
use App\Models\OrderDish;
use Inertia\Inertia;

class CashDeskOrdersController extends Controller
{
    public function index()
    {
        return Inertia::render('Manager/CashDesk/Orders/Index', [
            'orders' => Order::with('lines')->orderByDesc('created_at')->paginate()->through(function (Order $order) {
                return [
                    'id' => $order->id,
                    'status' => $order->status,
                    'price' => $order->price,
                    'seller' => $order->user->name ?? 'Customer',
                    'dishes_count' => $order->lines->sum('amount'),
                    'created_at' => $order->created_at,
                ];
            }),
        ]);
    }

    public function show(Order $order)
    {
        return Inertia::render('Manager/CashDesk/Orders/Show', [
            'order' => [
                'id' => $order->id,
                'seller' => $order->user->name ?? 'Customer',
                'table_number' => $order->table_number,
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

    public function status(StatusRequest $request, Order $order)
    {
        $data = $request->validated();

        $success = $order->update([
            'status' => $data['status'],
        ]);

        if ($success) {
            return redirect()->back()->with('success', 'De orderstatus is succesvol bijgewerkt');
        }

        return redirect()->back()->with('error', 'De orderstatus kon niet worden bijgewerkt');
    }
}
