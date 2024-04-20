<?php

namespace Database\Seeders;

use App\Models\HotelRoomType;
use Illuminate\Database\Seeder;

class HotelRoomTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = $this->generateRooms();
        $query = HotelRoomType::query();
        $query->insert($rooms);
    }

    private $RO0M_IMAGE_LINKS = [
        'Эконом' =>
        'https://www.palladaran.ru/uploads/images/ekonom-nomer.jpg',
        'Стандарт' =>
        'https://hotelnogai.ru/wp-content/uploads/2016/02/%D0%A1%D1%82%D0%B0%D0%BD%D0%B4_%D0%9A%D0%B8%D0%BD%D0%B3_1-1620x1080.jpg',
        'Люкс' =>
        'https://standarthotel.com/upload/resize_cache/iblock/f50/992_600_2/f5012a39efa74a5aa17ab74146f766f6.jpg',
        'Семейный' =>
        'https://trefenhotel.ru/upload/blog/Family_hotel_2.jpg',

    ];

    /**
     * @return array
     */
    private function generateRooms(): array
    {
        return [
            $this->createRoom(
                'Эконом',
                'Номер эконом идеален для двух гостей.
                Все необходимые удобства, кроме телевизора.',
                1500,
                $this->RO0M_IMAGE_LINKS['Эконом']
            ),
            $this->createRoom(
                'Стандарт',
                'Стандартный номер идеален для одного гостя.
            В нем есть уютная кровать, ванная комната и все необходимые удобства.',
                2500,
                $this->RO0M_IMAGE_LINKS['Стандарт']
            ),
            $this->createRoom(
                'Люкс',
                'Номер класса люкс предлагает роскошное пространство и
            высокий уровень комфорта. Он идеально подходит для гостей,
            которые ценят элегантность и уют.
            В номере класса люкс вы найдете просторную спальню
            с комфортной кроватью и изысканным интерьером.
            Также в номере есть отдельная гостиная зона,
            где можно отдохнуть и провести время в приятной обстановке.
            Ванная комната оснащена роскошными сантехническими принадлежностями,
            а также имеется отдельный душ и ванна.
            В номере класса люкс предусмотрены все необходимые удобства,
            чтобы сделать ваше пребывание максимально комфортным и приятным.',
                5200,
                $this->RO0M_IMAGE_LINKS['Люкс']
            ),
            $this->createRoom(
                'Семейный',
                'Семейный номер идеально подходит для семейного отдыха.
            В нем предусмотрено достаточное пространство для всей семьи,
            чтобы чувствовать себя комфортно и расслабленно.
            В номере есть несколько спален, чтобы обеспечить комфортное размещение
            для всех членов семьи. Кроме того, в номере есть просторная гостиная зона,
            где можно провести время вместе, смотреть телевизор или просто наслаждаться общением.
            Ванная комната оснащена всеми необходимыми удобствами, а также имеется отдельный душ
            и ванна. Семейный номер создан для того, чтобы сделать
            ваш семейный отдых приятным и комфортным.',
                4700,
                $this->RO0M_IMAGE_LINKS['Семейный']
            ),
        ];
    }

    /**
     * @param string $type
     * @param string $description
     * @param int $price
     * @param string $image = ''
     * @return array
     */
    private function createRoom(
        string $type,
        string $description,
        int $price,
        string $image = ''
    ): array {
        return [
            'type' => $type,
            'description' => $description,
            'price' => $price,
            'image' => $image,
        ];
    }
}
