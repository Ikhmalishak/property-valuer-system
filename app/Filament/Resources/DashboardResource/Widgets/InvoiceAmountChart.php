<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Invoice;

class InvoiceAmountChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Amaun Mengikut Status';

    protected function getData(): array
    {
        // Get total amount per status
        $statuses = [
            'pending',
            'paid',
            'overdue',
        ];

        $amounts = [];

        foreach ($statuses as $status) {
            $amount = Invoice::where('status', $status)
                ->sum('amount');
            $amounts[] = round($amount, 2); // Round to 2 decimal places
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Amaun (MYR)',
                    'data' => $amounts,
                    'backgroundColor' => [
                        '#f59e0b', // amber-500 for pending
                        '#10b981', // emerald-500 for paid
                        '#ef4444', // red-500 for overdue
                    ],
                ],
            ],
            'labels' => [
                'Menunggu',
                'Dibayar',
                'Tertunggak',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}