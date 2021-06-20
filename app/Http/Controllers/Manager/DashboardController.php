<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Dish;
use App\Models\Order;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Manager/Dashboard/Index', [
            'stats' => [
                [
                    'name' => 'Aantal gerechten',
                    'value' => Dish::count('id'),
                ],
                [
                    'name' => 'Aantal bestellingen',
                    'value' => Order::count('id'),
                ],
                [
                    'name' => 'Actieve kortingen',
                    'value' => Discount::whereActive()->count('id'),
                ],
            ],
        ]);
    }
}
