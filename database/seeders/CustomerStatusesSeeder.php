<?php

namespace Database\Seeders;

use App\Enums\Customers\CustomersStatusEnum;
use App\Models\CustomerStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (CustomersStatusEnum::toLabels() as $status => $label) {
            CustomerStatus::create([
                'name' => $label
            ]);
        }
    }
}
