<?php

namespace App\Filament\Admin\Resources\HotelRoomsResource\Pages;

use App\Filament\Admin\Resources\HotelRoomsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelRooms extends EditRecord
{
    protected static string $resource = HotelRoomsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
