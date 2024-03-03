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
                        Forms\Components\Textarea::make('description')
                            ->label('Описание')
                            ->autosize()
                            ->minLength(12)
                            ->maxLength(700)
                            ->placeholder('Описание для номера ...'),

                    ])->columns(1),

                Forms\Components\Section::make('Фото номера')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->uploadingMessage('Загружаем фото лучшего номера...')
                            ->image()
                            ->label('Фото')
                            ->imageEditor(),

                    ])->columns(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('id')->sortable()->label('id'),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'economy' => 'gray',
                        'standart' => 'primary',
                        'luxury' => 'success',
                        'family' => 'info'
                    })
                    ->label('Тип'),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(50)
                    ->label('Описание'),
                Tables\Columns\TextColumn::make('price')
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
