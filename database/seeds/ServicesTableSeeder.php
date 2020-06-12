<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Service;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) {
            $service = new Service;
            $service->name = $faker->word;
            $service->service_icon = $faker->imageUrl($width = 50, $height = 50);
            $service->save();

        }
    }
}
