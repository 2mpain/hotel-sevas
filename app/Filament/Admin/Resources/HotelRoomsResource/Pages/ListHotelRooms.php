<?php

namespace App\Filament\Admin\Resources\HotelRoomsResource\Pages;

use App\Filament\Admin\Resources\HotelRoomsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotelRooms extends ListRecords
{
    protected static string $resource = HotelRoomsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
