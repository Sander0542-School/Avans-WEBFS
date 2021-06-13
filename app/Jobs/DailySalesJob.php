<?php

namespace App\Jobs;

use App\Exports\OrdersExport;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DailySalesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $yesterday = Carbon::yesterday(); //Yesterday because jobs runs at 00:15
        $filePath = 'sales/Orders_'.$yesterday->format('Y_m_d').'.xlsx';

        $export = new OrdersExport($yesterday);
        $export->store($filePath);
    }
}
