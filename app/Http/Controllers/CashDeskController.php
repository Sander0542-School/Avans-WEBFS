<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        //dd($request->input('cart'));
        //Request::validate([
        //    'cart.*.id' => ['required', 'max:50', 'integer'],
        //]);

        $validated = $request->validate([
            'cart.*.id' => ['required', 'max:50', 'integer'],
            'cart.*.quantity' => ['required', 'max:50', 'integer'],
            'cart.*.remark' => ['max:150', 'string', 'nullable'],
        ]);
        //dd($validated);

        $order = Order::create([
            'user_id' => \Auth::user()->id,
            'table_number' => null
        ]);

        $items = array();

        foreach ($request->input('cart') as $line){

            $newLine = array('order_id' => $order->id, 'dish_id' => $line['id'], 'amount' => $line['quantity'],'unit_price' => $line['price'], 'remark' => $line['remark']);
            array_push($items, $newLine);
        }
        //dd($items);

        $order->lines()->createMany([
            $items
        ]);

        //return Redirect::route('users.show', $user);
    }
}
