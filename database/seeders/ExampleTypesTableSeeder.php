<?php

namespace Database\Seeders;

use App\Modules\ExampleType\Models\ExampleType;
use Illuminate\Database\Seeder;

class ExampleTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExampleType::factory()->count(50)->create();
    }
}
