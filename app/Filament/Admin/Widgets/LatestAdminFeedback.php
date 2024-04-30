<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Feedback;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAdminFeedback extends BaseWidget
{
    protected static ?string $heading = 'Последние оставленные отзывы';
    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(Feedback::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')->label('Автор'),
                TextColumn::make('message')->label('Сообщение')->limit(15),
                TextColumn::make('email')->badge()->copyable(),
            ]);
    }
}
