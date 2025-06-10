<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ID is auto-incremented, not editable
            Forms\Components\TextInput::make('id')
                ->numeric()
                ->disabled()
                ->hidden(),

            // Name
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->label('Full Name'),

            // Role (assuming this is a string like 'admin', 'user', etc.)
            Forms\Components\TextInput::make('role')
                ->required()
                ->maxLength(255)
                ->default('user')
                ->label('User Role'),

            // Email
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            // Password
            Forms\Components\TextInput::make('password')
                ->password()
                ->required(fn (string $context): bool => $context === 'create')
                ->confirmed()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->helperText('Leave blank to keep current password')
                ->visibleOn(['create']),

            Forms\Components\TextInput::make('password_confirmation')
                ->password()
                ->label('Confirm Password')
                ->requiredWith('password')
                ->dehydrated(false)
                ->visibleOn(['create']),

            // Stripe Fields (for Laravel Cashier)
            Forms\Components\TextInput::make('stripe_id')
                ->maxLength(255)
                ->label('Stripe ID')
                ->nullable(),

            Forms\Components\TextInput::make('pm_type')
                ->maxLength(255)
                ->label('Payment Method Type')
                ->nullable(),

            Forms\Components\TextInput::make('pm_last_four')
                ->maxLength(4)
                ->label('Last Four Digits')
                ->nullable(),

            Forms\Components\DateTimePicker::make('trial_ends_at')
                ->label('Trial Ends At')
                ->nullable(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Registered At')
                ->dateTime(), // Formats as date + time
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
