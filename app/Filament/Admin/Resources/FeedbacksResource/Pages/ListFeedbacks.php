<?php

namespace App\Filament\Admin\Resources\FeedbacksResource\Pages;

use App\Filament\Admin\Resources\FeedbacksResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFeedbacks extends ListRecords
{
    protected static string $resource = FeedbacksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
