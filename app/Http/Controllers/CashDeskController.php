<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Dish;
use App\Models\MenuCategory;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'user_id' => \Auth::user()->id,
            'table_number' => null
        ]);

        $items = [];
        foreach ($request->input('cart') as $line){
            $dish = Dish::findOrFail($line['id']);
            $newLine = ['order_id' => $order->id, 'dish_id' => $dish->id, 'amount' => $line['quantity'],'unit_price' => $dish->getPriceIncAttribute(), 'remark' => $line['remark']];
            array_push($items, $newLine);
        }

        $order->lines()->createMany(
            $items
        );

        //return Redirect::route('cashdesk.dishes');
        return redirect()->back()->with('message', 'Order succesvol aangemaakt.');
    }

}
