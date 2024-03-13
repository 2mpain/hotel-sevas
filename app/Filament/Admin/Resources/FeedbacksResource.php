<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FeedbacksResource\Pages;
use App\Models\Feedback;
use Filament\Forms;
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
        $customers = \App\Models\Customer::all()->pluck('email', 'id')->filter()->toArray();
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация отзыва')
                    ->schema([
                        Forms\Components\TextInput::make('name')->label('Автор отзыва')->required(),
                        Forms\Components\RichEditor::make('message')
                            ->disableToolbarButtons([
                                'codeBlock',
                            ])
                            ->label('Содержимое')
                            ->required(),
                    ])->columns(1),
                Forms\Components\Section::make('Дополнительная информация отзыва')
                    ->description('Укажите электронный адрес автора отзыва, если он является клиентом отеля.')
                    ->schema([
                            Forms\Components\Select::make('customer_id')
                            ->options($customers)
                            ->label('E-mail клиента'),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->description(function (Feedback $record): string {
                        $message = strip_tags($record->message);
                        return mb_strlen($message) > 80
                        ? mb_substr($message, 0, 80) . '...'
                        : $message;
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
                    ->url(fn() => '/admin/customers/', true)
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-identification')
                    ->label('ID Клиента'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
