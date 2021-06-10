<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use PDF;

class DownloadController extends Controller
{
    public function menu()
    {
        $pdf = PDF::loadView('pdf.menu', [
            'menu' => MenuCategory::menuData(),
        ]);

        return $pdf->stream('GoudenDraak Menu.pdf');
    }
}
