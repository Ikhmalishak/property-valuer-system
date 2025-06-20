<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReminderResource\Pages;
use App\Filament\Resources\ReminderResource\RelationManagers;
use App\Models\Reminder;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReminderResource extends Resource
{
    protected static ?string $model = Reminder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name') // <- show names, store user_id
                    ->searchable() // optional, for large user list
                    ->required(),
                TextInput::make('title'),
                TextInput::make('message'),
                DatePicker::make('due_date'),
                Toggle::make('is_sent')

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label("name"),
                TextColumn::make('title'),
                TextColumn::make('message'),
                TextColumn::make('due_date'),
                ToggleColumn::make('is_sent')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Send Reminder')
                ->action(function(Reminder $record){
                    $record->sendEmailReminder();
                    $record->update(['is_sent' => true]);
                })
                ->icon('heroicon-m-paper-airplane')
                ->requiresConfirmation()
                ->color('success'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReminders::route('/'),
            'create' => Pages\CreateReminder::route('/create'),
            'edit' => Pages\EditReminder::route('/{record}/edit'),
        ];
    }
}
