<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Сайт';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Пользователи';
    protected static ?string $pluralModelLabel = 'Пользователи сайта';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Основная информация')
                    ->description('Основные данные пользователя')
                    ->schema([
                        Forms\Components\TextInput::make('name')->required()->label('Имя на сайте'),
                        Forms\Components\TextInput::make('username')->required()->label('Логин'),

                    ])->columns(2),

                Forms\Components\Section::make('Контактная информация')
                    ->description('Поле Номер телефона необязательно.')
                    ->schema([
                        Forms\Components\TextInput::make('email')->email()->required()->label('Эл.почта'),
                        Forms\Components\TextInput::make('phoneNumber')->tel()->label('Номер телефона'),
                    ])->columns(2),

                Forms\Components\Section::make('Аутентификация и роль')
                    ->description('Пароль и роль пользователя на сайте.')
                    ->schema([
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->label('Пароль')
                        ,
                        Select::make('role')->required()->label('Роль')->options([
                            'admin' => 'Администратор',
                            'user' => 'Пользователь',
                        ]),
                    ])->columns(2),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //Tables\Columns\TextColumn::make('id')->sortable()->label('id'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Имя'),
                Tables\Columns\TextColumn::make('username')
                    ->copyable()
                    ->icon('heroicon-m-user')
                    ->searchable()
                    ->sortable()
                    ->label('Логин'),
                Tables\Columns\TextColumn::make('phoneNumber')
                    ->copyable()
                    ->icon('heroicon-m-phone')
                    ->label('Номер телефона'),
                Tables\Columns\TextColumn::make('email')
                    ->copyable()
                    ->icon('heroicon-m-envelope')
                    ->searchable()
                    ->label('Эл.почта'),
                Tables\Columns\TextColumn::make('role')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'info',
                        'user' => 'success',
                        default => 'gray'
                    })
                    ->searchable()
                    ->label('Роль')
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
            //RelationManagers\CustomerRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

}
