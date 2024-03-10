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
                        // Forms\Components\Select::make('gender')
                        //     ->label('Пол')
                        //     ->options([
                        //         'male' => 'Мужской',
                        //         'female' => 'Женский',
                        //         'none' => 'Н/Д',
                        //     ]),
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
                    ])->columns(1),

                // Forms\Components\Section::make('Аутентификация')
                //     ->description('Заполните поле Логин и Пароль в том случае, если клиент является пользователем сайта.')
                //     ->schema([
                //         Forms\Components\TextInput::make('username')->label('Логин на сайте'),
                //         Forms\Components\TextInput::make('password')->password()->label('Пароль'),

                //     ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('id')->sortable()->label('id'),

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
                    ->label('Отчество'),
                // Tables\Columns\TextColumn::make('gender')
                //     ->sortable()
                //     ->label('Пол'),
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
                    ->color(fn(string $state): string => match ($state) {
                        'left_a_request' => 'primary',
                        'active' => 'success',
                        'inactive' => 'danger',
                    })
                    ->label('Статус'),
                // Tables\Columns\TextColumn::make('username')
                //     ->searchable()
                //     ->sortable()
                //     ->label('Логин на сайте'),
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
                //Tables\Actions\DeleteAction::make()->label('Удалить'),
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
