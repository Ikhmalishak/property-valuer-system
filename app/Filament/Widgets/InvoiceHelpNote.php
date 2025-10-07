<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Request;

class InvoiceHelpNote extends Widget
{
    protected static string $view = 'filament.pages.invoices-help-note';

    protected static bool $isLazy = false;

    public static function canView(): bool
    {
        // Only show on /admin/invoices or its subpages
        return Request::is('admin/invoices*');
    }
}