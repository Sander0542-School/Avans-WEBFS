<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function menu()
    {
        return Inertia::render('Menu', [
            'menu' => MenuCategory::with('dishes')->get(),
        ]);
    }
}
