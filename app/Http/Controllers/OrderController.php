<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Events\CustomerRequestCreated;
use App\Http\Requests\Order\StoreRequest;
use App\Models\CustomerHelpRequest;
use App\Models\Dish;
use App\Models\MenuCategory;
use App\Models\Order;
use App\Models\OrderDish;
use Illuminate\Http\Request;
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
            'dishes' => Dish::cartData(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $order = Order::create([
            'customer' => $data['customer'],
            'table_number' => $data['table_order'] ? $data['table_number'] : null,
            'status' => OrderStatus::OPEN(),
        ]);

        if ($order != null) {
            $order->lines()->createMany(collect($data['cart'])->map(function ($item) {
                $dish = Dish::find($item['id'], ['id', 'price', 'btw']);

                return [
                    'dish_id' => $dish->id,
                    'amount' => $item['amount'] ?? 1,
                    'unit_price' => $dish->price,
                    'btw' => $dish->btw,
                    'remark' => $item['remark'] ?? null,
                    'rice_option_id' => $item['rice_option_id'] ?? null,
                ];
            }));

            return redirect()->route('order.confirmed', [$order->id, 'token' => $order->customer_token])->with('success', 'De bestelling is succesvol verwerkt');
        }

        return redirect()->back()->with('error', 'De bestelling kon niet worden verwerkt');
    }

    public function confirmed(Order $order, $token = null)
    {
        return Inertia::render('Order/Confirmed', [
            'order' => $token == $order->customer_token ? [
                'id' => $order->id,
                'customer' => $order->customer ?? '???',
                'price_inc' => $order->price_inc,
                'qr_code_url' => 'https://api.qrserver.com/v1/create-qr-code/?data='.$order->qr_code,
            ] : null,
        ]);
    }

    public function employeeAssistance(Request $request)
    {
        $customerRequest = new CustomerHelpRequest();
        $customerRequest->table_number = $request->table_number;
        $customerRequest->save();

        return redirect()->back();
    }
}
