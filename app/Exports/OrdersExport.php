<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderDish;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrdersExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting, WithProperties, ShouldAutoSize
{
    use Exportable;

    private $date;

    public function __construct($date = null)
    {
        $this->date = $date ?? today();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Order::whereDate('created_at', $this->date)->with('lines')->get();
    }

    /**
     * @param Order $order
     * @return array
     */
    public function map($order): array
    {
        return array_merge($order->lines->map(function (OrderDish $line, $id) use ($order) {
            return [
                $id == 0 ? $order->id : '',
                $id == 0 ? $order->created_at->format('d-m-Y H:i') : '',
                $line->dish->name,
                $line->amount,
                $line->unit_price,
                $line->btw / 100,
                $line->price,
                $line->price_inc,
            ];
        })->toArray(), [
            [
                '',
                '',
                '',
                $order->lines->sum('amount'),
                '',
                '',
                $order->price,
                $order->price_inc,
            ],
        ]);
    }

    public function headings(): array
    {
        return [
            'Bestelling',
            'Tijdstempel',
            'Gerecht',
            'Aantal',
            'Stukprijs (ex)',
            'BTW',
            'Prijs (ex)',
            'Prijs (inc)',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_ACCOUNTING_EUR,
            'F' => NumberFormat::FORMAT_PERCENTAGE,
            'G' => NumberFormat::FORMAT_ACCOUNTING_EUR,
            'H' => NumberFormat::FORMAT_ACCOUNTING_EUR,
        ];
    }

    public function properties(): array
    {
        return [
            'creator' => 'GoudenDraak',
            'title' => 'GoudenDraak Orders ('.$this->date->format('d-m-Y').')',
            'description' => 'GoudenDraak Orders. Generated on '.now()->format('d-m-Y H:i'),
            'subject' => 'Orders',
            'keywords' => 'orders,export',
            'category' => 'Orders',
            'company' => 'GoudenDraak',
        ];
    }
}
