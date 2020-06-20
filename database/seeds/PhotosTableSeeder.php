<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Photo;
use App\House;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10 ; $i++) {
            $house = House::inRandomOrder()->first();
            $photo = new Photo;
            $photo->house_id = $house->id;
            $photo->name = $faker->word;
            $photo->description = $faker->sentence;
            $photo->path = $faker->imageUrl($width = 400, $height = 500);
            $photo->save();

        }
    }
}
