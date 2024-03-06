<?php

namespace App\Filament\Admin\Resources\HotelRoomTypeResource\Pages;

use App\Filament\Admin\Resources\HotelRoomTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotelRoomTypes extends ListRecords
{
    protected static string $resource = HotelRoomTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
