<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAdminUser extends BaseWidget
{

    protected static ?string $heading = 'Последние зарегестрировавшиеся пользователи';
    protected static ?int $sort = 5;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')->label('Имя'),
                TextColumn::make('username')->label('Логин'),
                TextColumn::make('email')->copyable(),
                TextColumn::make('phoneNumber')->label('Номер телефона')->badge('info')->copyable(),
                TextColumn::make('role')
                    ->label('Роль')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'info',
                        'user' => 'success',
                        default => 'gray'
                    }),
                TextColumn::make('created_at')->label('Дата создания'),
            ]);
    }
}
