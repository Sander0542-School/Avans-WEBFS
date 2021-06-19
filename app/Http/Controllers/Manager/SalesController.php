<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Inertia\Inertia;
use Storage;

class SalesController extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index()
    {
        $files = collect(Storage::allFiles('sales'));
        $dates = $files->map(function ($file) {
            return Carbon::createFromFormat('Y_m_d H:i', str_replace('sales/Orders_', '', str_replace('.xlsx', '', $file)).' 00:00');
        })->sortDesc()->take(50);

        $orders = Order::whereIn(\DB::raw('DATE(`created_at`)'), $dates)->groupByRaw('DATE(`created_at`)')
            ->selectRaw('DATE(`created_at`) as date, count(`id`) as orders')->get();

        return Inertia::render('Manager/Sale/Index', [
            'sales' => $dates->map(function (Carbon $date) use ($orders) {
                $order = $orders->firstWhere('date', $date->format('Y-m-d'));

                return [
                    'date' => $date,
                    'date_key' => $date->format('Y-m-d'),
                    'orders' => $order->orders ?? 0,
                ];
            }),
        ]);
    }

    /**
     * @param \Carbon\Carbon $date
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(Carbon $date)
    {
        $filePath = 'sales/Orders_'.$date->format('Y_m_d').'.xlsx';

        if (!Storage::exists($filePath)) {
            abort(404);
        }

        return Storage::download($filePath);
    }
}
