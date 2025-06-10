<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource; // ✅ This is the correct import
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class; // ✅ Now it's correct

    protected function getTableQuery(): ?Builder
    {
        return \App\Models\User::query(); // Or your model as needed
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make(),
        ];
    }
}