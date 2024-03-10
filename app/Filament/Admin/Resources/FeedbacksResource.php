<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FeedbacksResource\Pages;
use App\Models\Feedback;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeedbacksResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Обратная связь';
    protected static ?string $pluralModelLabel = 'Обратная связь';
    protected static ?string $navigationGroup = 'Сайт';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->description(function (Feedback $record): string {
                        return mb_strlen($record->message) > 80
                        ? mb_substr($record->message, 0, 80) . '...'
                        : $record->message;
                    })
                    ->icon('heroicon-m-user')
                    ->limit(30)
                    ->searchable()
                    ->sortable()
                    ->label('Отзыв'),
                Tables\Columns\TextColumn::make('email')
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->searchable()
                    ->sortable()
                    ->label('Эл.почта'),
                Tables\Columns\TextColumn::make('customer_id')
                ->url(fn () => '/admin/customers/' , true)
                    ->searchable()
                    ->sortable()
                    ->label('ID Клиента'),
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
            'index' => Pages\ListFeedbacks::route('/'),
            'create' => Pages\CreateFeedbacks::route('/create'),
            'edit' => Pages\EditFeedbacks::route('/{record}/edit'),
        ];
    }
}
