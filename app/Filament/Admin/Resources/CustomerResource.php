<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CustomerResource\Pages;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?string $navigationGroup = 'Отель';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Клиенты';

    protected static ?string $pluralModelLabel = 'Клиенты отеля';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->description('Основные данные клиента. Поле Отчество является необязательным к заполнению.')
                    ->schema([
                        Forms\Components\TextInput::make('last_name')->label('Фамилия')->required(),
                        Forms\Components\TextInput::make('first_name')->label('Имя')->required(),
                        Forms\Components\TextInput::make('middle_name')->label('Отчество'),
                    ])->columns(3),

                Forms\Components\Section::make('Контактная информация')
                    ->description('Адрес электронной почты и контактный номер клиента.')
                    ->schema([
                        Forms\Components\TextInput::make('email')->email()->required()->label('Эл.почта'),
                        Forms\Components\TextInput::make('phoneNumber')->tel()->required()->label('Номер телефона'),
                    ])->columns(2),

                Forms\Components\Section::make('Статус клиента')
                    ->description('Текущий статус клиента.')
                    ->schema([

                        Forms\Components\Select::make('status')
                            ->required()
                            ->label('Статус')
                            ->options([
                                'left_a_request' => 'Оставил заявку',
                                'active' => 'Проживает в отеле',
                                'inactive' => 'Выселился',
                            ]),

                        Forms\Components\Section::make('Даты проживания')
                            ->description('Даты проживания клиента.')
                            ->schema([
                                Forms\Components\DatePicker::make('arrival_date')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d M Y')
                                    ->seconds(false)
                                    ->prefixIcon('heroicon-m-calendar')
                                    ->label('Дата прибытия'),
                                Forms\Components\DatePicker::make('departure_date')
                                    ->required()
                                    ->native(false)
                                    ->displayFormat('d M Y')
                                    ->seconds(false)
                                    ->prefixIcon('heroicon-m-calendar')
                                    ->label('Дата убытия'),

                            ])->columns(2),

                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->sortable()
                    ->label('Фамилия'),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable()
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable()
                    ->sortable()
                    ->default('-')
                    ->label('Отчество'),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->label('Эл.почта'),
                Tables\Columns\TextColumn::make('phoneNumber')
                    ->copyable()
                    ->icon('heroicon-m-phone')
                    ->searchable()
                    ->label('Номер телефона'),
                Tables\Columns\TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'left_a_request' => 'primary',
                        'active' => 'success',
                        'inactive' => 'danger',
                    })
                    ->label('Статус'),
                Tables\Columns\TextColumn::make('arrival_date')
                    ->icon('heroicon-m-calendar-days')
                    ->label('Дата прибытия')
                    ->dateTime('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('departure_date')
                    ->icon('heroicon-m-calendar-days')
                    ->label('Дата отъезда')
                    ->dateTime('Y-m-d')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата обновления')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
