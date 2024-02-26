<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HotelRoomTypeResource\Pages;
use App\Filament\Admin\Resources\HotelRoomTypeResource\RelationManagers;
use App\Models\HotelRoomType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->placeholder('Новый тип'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->step(100)
                    ->placeholder(3500),
                Forms\Components\Textarea::make('description')
                    ->autosize()
                    ->minLength(12)
                    ->maxLength(256)
                    ->placeholder('Описание для номера ...'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->label('id'),
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
                Tables\Columns\TextColumn::make('description')->limit(50)->label('Описание'),
                Tables\Columns\TextColumn::make('price')->money('RUB')->sortable()->label('Цена'),
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
