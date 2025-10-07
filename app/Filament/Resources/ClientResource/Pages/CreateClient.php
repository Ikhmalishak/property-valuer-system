<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    // Automatically assign the correct user_id based on email
    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $email = $data['email'] ?? null;

        // Find user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            // If no user exists, create one? Or throw error?
            return parent::handleRecordCreation($data);
        }

        // Set user_id from found user
        $data['user_id'] = $user->id;

        return parent::handleRecordCreation($data);
    }

    public function getTitle(): string
    {
        return 'Tambah Klien';
    }

    public function getBreadcrumb(): string
    {
        return 'Cipta Klien';
    }
}