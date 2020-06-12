<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Message;
use App\House;

class MessagesTableSeeder extends Seeder
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
            $message = new Message;
            $message->house_id = $house->id;
            $message->email = $faker->email;
            $message->body = $faker->paragraph;


            $message->save();

        }
    }
}
