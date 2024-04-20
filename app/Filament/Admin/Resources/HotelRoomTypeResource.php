<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HotelRoomTypeResource\Pages;
use App\Models\HotelRoomType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HotelRoomTypeResource extends Resource
{
    protected static ?string $model = HotelRoomType::class;
    protected static ?string $navigationGroup = 'Отель';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Типы номеров';
    protected static ?string $pluralModelLabel = 'Типы номеров отеля';

    protected static ?string $navigationIcon = 'heroicon-o-sun';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->schema([
                        Forms\Components\TextInput::make('type')
                            ->label('Тип номера')
                            ->required()
                            ->placeholder('Новый тип'),
                        Forms\Components\TextInput::make('price')
                            ->label('Стоимость')
                            ->required()
                            ->numeric()
                            ->step(100)
                            ->placeholder(3500),
                    ])->columns(2),

                Forms\Components\Section::make('Описание номера отеля')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->disableToolbarButtons([
                                'codeBlock',
                            ])
                            ->label('Описание')
                            ->placeholder('Описание для номера ...'),

                    ])->columns(1),

                Forms\Components\Section::make('Фото номера')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->default(function ($model) {
                                return $model->image ?? '';
                            })
                            ->uploadingMessage('Загружаем фото лучшего номера...')
                            ->image()
                            ->label('Фото')
                            ->previewable(true)
                            ->imageEditor(),

                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->searchable()
                    ->description(function (HotelRoomType $record): string {
                        $description = strip_tags($record->description);
                        return mb_strlen($description) > 80
                            ? mb_substr($description, 0, 80) . '...'
                            : $description;
                    })
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Эконом' => 'gray',
                        'Стандарт' => 'primary',
                        'Люкс' => 'success',
                        'Семейный' => 'info',
                        default => 'gray'
                    })
                    ->label('Тип'),
                Tables\Columns\TextColumn::make('price')
                    ->icon('heroicon-m-banknotes')
                    ->searchable()
                    ->money('RUB')
                    ->sortable()
                    ->label('Цена'),
                Tables\Columns\ImageColumn::make('image')
                    ->size(70)
                    ->label('Фото')
                    ->circular(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Просмотр'),
                Tables\Actions\EditAction::make()->label('Редакт.'),
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
            'index' => Pages\ListHotelRoomTypes::route('/'),
            'create' => Pages\CreateHotelRoomType::route('/create'),
            'edit' => Pages\EditHotelRoomType::route('/{record}/edit'),
        ];
    }
}
