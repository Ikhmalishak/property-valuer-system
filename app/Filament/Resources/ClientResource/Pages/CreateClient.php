<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    // Automatically assign the authenticated user's ID
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $data['user_id'] = Auth::id(); // Get current logged-in user's ID

        return parent::handleRecordCreation($data);
    }

    public function getTitle(): string
    {
        return 'Tambah Klien'; // page title
    }
    // Change breadcrumb text
    public function getBreadcrumb(): string
    {
        return 'Cipta Klien';
    }
}