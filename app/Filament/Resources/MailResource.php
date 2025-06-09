<?php

namespace App\Filament\Resources;


use App\Filament\Resources\MailResource\Pages;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Vormkracht10\Mails\Models\Mail;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Mail as MailFacade;
use App\Mail\ResendableMail; // ← You'll need to create this class!
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions;

class MailResource extends Resource
{
    protected static ?string $model = Mail::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Email Logs';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('subject')->limit(50),
                TextColumn::make('to.email')->label('To'),
                TextColumn::make('from.email')->label('From'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match($state) {
                        'sent' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')->dateTime(), // ✅ Works in v3
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Actions\ViewAction::make(),
                Actions\Action::make('resend')
                    ->label('Resend')
                    ->icon('heroicon-m-arrow-path')
                    ->action(function (Model $record) {
                        $mail = Mail::with(['to'])->find($record->id);

                        if (!$mail) {
                            throw new \Exception("Mail not found");
                        }

                        // Reconstruct the mailable
                        $mailable = new ResendableMail($mail);

                        // Send it again
                        MailFacade::to($mail->to->pluck('email'))->send($mailable);
                    })
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Email Details')
                    ->schema([
                        TextEntry::make('subject'),
                        TextEntry::make('from.email')->label('From'),
                        TextEntry::make('to.email')->label('To'),
                        TextEntry::make('cc.email')->label('CC'),
                        TextEntry::make('bcc.email')->label('BCC'),
                        TextEntry::make('reply_to.email')->label('Reply To'),
                        TextEntry::make('status')->badge(),
                        TextEntry::make('created_at')->dateTime()->label('Sent At'), // ✅ Works in v3
                    ]),
                Section::make('Body')
                    ->schema([
                        TextEntry::make('html_body')
                            ->hiddenLabel()
                            ->prose()
                            ->html(),
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
            'index' => Pages\ListMails::route('/'),
            'view' => Pages\ViewMail::route('/{record}'),
        ];
    }
}