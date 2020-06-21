<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;
use App\House;
use App\Photo;
use App\Service;
use App\Promotion;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) {
            $user = User::inRandomOrder()->first();
            $house = new House;
            $house->user_id = $user->id;
            $house->title = $faker->sentence;
            $house->description = $faker->paragraph;
            $house->latitude = $faker->latitude;
            $house->longitude = $faker->longitude;
            $house->rooms = $faker->numberBetween($min = 1, $max = 25);
            $house->beds = $faker->numberBetween($min = 1, $max = 10);
            $house->bathrooms = $faker->numberBetween($min = 1, $max = 5);
            $house->photo = $faker->imageUrl($width = 640, $height = 480);
            $house->mq = $faker->numberBetween($min = 1, $max = 1000);
            $house->address = $faker->address;
            $house->visible = $faker->boolean($chanceOfGettingTrue = 50);

            $house->save();

            $promotions = Promotion::inRandomOrder()->limit(3)->get();
            $house->promotions()->attach($promotions);

            $services = Service::inRandomOrder()->get();
            $house->services()->attach($services);

        }
    }
}
