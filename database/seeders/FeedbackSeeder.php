<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $query = Feedback::query();

        $query->insert([
            [
                'name' => 'Станислав',
                'message' => 'Очень понравилось в Вашем отеле. Спасибо!',
                'email' => 'stas123@yandex.ru',
                'customer_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Дэнчик',
                'message' => 'Ужасный сервис, уходите с рынка. Вам не рады.',
                'email' => 'danik123@mail.ru',
                'customer_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Мария',
                'message' => 'В целом довольно неплохо, однако хотелось бы, чтобы почаще были какие-нибудь акции и скидки на различные праздники в течение года. А так, в целом, придраться не к чему. Все организовано на высоком уровне!',
                'email' => 'avemaria@gmail.com',
                'customer_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
