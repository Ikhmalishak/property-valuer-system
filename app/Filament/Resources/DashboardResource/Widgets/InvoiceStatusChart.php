<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Invoice;

class InvoiceStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Invoices by Status';

    protected function getData(): array
    {
        // Get counts per status
        $statuses = [
            'pending',
            'paid',
            'overdue',
        ];

        $counts = [];

        foreach ($statuses as $status) {
            $counts[] = Invoice::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Invoices',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#f59e0b', // amber-500 for pending
                        '#10b981', // emerald-500 for paid
                        '#ef4444', // red-500 for overdue
                    ],
                ],
            ],
            'labels' => [
                'Pending',
                'Paid',
                'Overdue',
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
