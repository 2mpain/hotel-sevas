<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HotelRoomsResource\Pages;
use App\Models\Customer;
use App\Models\HotelRoom;
use App\Models\HotelRoomStatus;
use App\Models\HotelRoomType;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HotelRoomsResource extends Resource
{
    protected static ?string $model = HotelRoom::class;
    protected static ?string $navigationGroup = 'Отель';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Номера';
    protected static ?string $pluralModelLabel = 'Номера отеля';

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Основная информация')
                    ->schema([
                        Select::make('floor')
                            ->label('Этаж')
                            ->required()
                            ->options(HotelRoom::select('floor')
                            ->groupBy('floor')
                            ->pluck('floor', 'floor'),
                        ),
                        Select::make('status_id')
                            ->label('Статус')
                            ->required()
                            ->options(HotelRoomStatus::all()->pluck('name', 'id')),
                        Select::make('room_type_id')
                            ->label('Тип')
                            ->required()
                            ->options(HotelRoomType::all()->pluck('type', 'id')),

                        Section::make('')
                            ->schema([
                                TextInput::make('number')
                                    ->label('Номер комнаты')
                                    ->numeric()
                                    ->step(1)
                                    ->required(),

                                Select::make('customer_id')
                                    ->label('Клиент')
                                    ->options(Customer::all()->pluck('first_name', 'id')->sort()),

                            ])->columns(2),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->label('ID'),
                TextColumn::make('floor')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'primary',
                        '2' => 'info',
                        default => 'info'
                    })
                    ->label('Этаж'),
                TextColumn::make('status.name')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'На брони' => 'primary',
                        'Уборка' => 'info',
                        'В аренде' => 'success',
                        'Свободен' => 'gray',
                        'Подлежит ремонту' => 'danger',
                        default => 'info'
                    })
                    ->label('Статус'),
                TextColumn::make('roomType.type')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Семейный' => 'info',
                        'Эконом' => 'gray',
                        'Люкс' => 'success',
                        'Стандарт' => 'gray',
                        default => 'info'
                    })
                    ->label('Тип'),
                TextColumn::make('number')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->label('Номер'),
                TextColumn::make('customer.phoneNumber')
                    ->default('-')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->label('Тел. номер клиента'),
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
            'index' => Pages\ListHotelRooms::route('/'),
            'create' => Pages\CreateHotelRooms::route('/create'),
            'edit' => Pages\EditHotelRooms::route('/{record}/edit'),
        ];
    }
}
