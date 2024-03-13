<?php

namespace App\Filament\Admin\Resources\HotelRoomTypeResource\Pages;

use App\Filament\Admin\Resources\HotelRoomTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelRoomType extends EditRecord
{
    protected static string $resource = HotelRoomTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
