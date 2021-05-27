<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/Index');
    }

    public function menu()
    {
        return Inertia::render('Home/Menu', [
            'menu' => MenuCategory::with('dishes')->get(),
        ]);
    }

    public function contact()
    {
        return Inertia::render('Home/Contact');
    }

    public function news()
    {
        return Inertia::render('Home/News');
    }

    public function discounts()
    {
        return Inertia::render('Home/Discounts');
    }
}
