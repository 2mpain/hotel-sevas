<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Customer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAdminCustomer extends BaseWidget
{
    protected static ?string $heading = 'Последние изменённые данные клиентов';
    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(Customer::query())
            ->defaultSort('updated_at', 'desc')
            ->columns([
                TextColumn::make('first_name')->label('Имя'),
                TextColumn::make('last_name')->label('Фамилия'),
                TextColumn::make('statusName.name')
                    ->label('Статус')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Выселился' => 'danger',
                        'Проживает' => 'primary',
                        'Оставил заявку' => 'success',
                        default => 'info'
                    })
                ,
                TextColumn::make('phoneNumber')
                    ->label('Номер телефона')
                    ->badge()
                    ->color('info')
                    ->copyable(),
            ]);
    }
}
