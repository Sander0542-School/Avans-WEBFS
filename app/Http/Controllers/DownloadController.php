<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\MenuCategory;
use PDF;

class DownloadController extends Controller
{
    public function menu()
    {
        $pdf = PDF::loadView('pdf.menu', [
            'menu' => MenuCategory::menuData(),
            'discounts' => Discount::whereActive()->with('dishes')->get(),
        ]);

        return $pdf->stream('GoudenDraak Menu.pdf');
    }
}
