<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('feedbacks')->insert([
            [
                'name' => 'Станислав',
                'email' => 'stas123@yandex.ru',
                'message' => 'Очень понравилось в Вашем отеле. Спасибо!',
                'customer_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Дэнчик',
                'email' => 'danik123@mail.ru',
                'message' => 'Ужасный сервис, уходите с рынка. Вам не рады.',
                'customer_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Мария',
                'email' => 'avemaria@gmail.com',
                'message' => 'В целом довольно, однако хотелось бы, чтобы почаще были какие-нибудь акции и скидки на различные праздники в течение года. А так, в целом, придраться не к чему. Все организовано на высоком уровне!',
                'customer_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);
    }
}
