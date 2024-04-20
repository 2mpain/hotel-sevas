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
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Обратная связь';
    protected static ?string $pluralModelLabel = 'Обратная связь';
    protected static ?string $navigationGroup = 'Сайт';

    public static function form(Form $form): Form
    {
        $customers = \App\Models\Customer::all()->pluck('email', 'id')->filter()->toArray();
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
                        Forms\Components\DateTimePicker::make('created_at')
                            ->native(false)
                            ->displayFormat('d M Y, H:i')
                            ->seconds(false)
                            ->label('Дата публикации отзыва'),
                    ])->columns(1),
                Forms\Components\Section::make('Дополнительная информация отзыва')
                    ->description('Укажите электронный адрес автора отзыва, если он является клиентом отеля.')
                    ->schema([
                        Forms\Components\Select::make('customer_id')
                            ->options($customers)
                            ->label('E-mail клиента'),
                    ])->columns(1),
                Forms\Components\Section::make('Фото отзыва')
                    ->schema([
                        Forms\Components\FileUpload::make('feedback_photo')
                            ->default(function ($model) {
                                return $model->feedback_photo ?? '';
                            })
                            ->uploadingMessage('Загружаем фото вашего отзыва...')
                            ->image()
                            ->label('Фото отзыва')
                            ->previewable(true)
                            ->imageEditor(),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('feedback_photo')
                    ->size(70)
                    ->label('Фото')
                    ->circular(),

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
                Tables\Columns\TextColumn::make('customer_id')
                    ->url(fn () => '/admin/customers/', true)
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-identification')
                    ->label('ID Клиента'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y, H:i')
                    ->searchable()
                    ->sortable()
                    ->icon('heroicon-m-clock')
                    ->label('Дата создания'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
