<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Promotion;

class PromotionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

            $promotion24 = new Promotion;
            $promotion72 = new Promotion;
            $promotion144 = new Promotion;
            $promotion24->name = '24 ore di sponsorizzazione';
            $promotion24->price = '2.99';
            $promotion24->start = $faker->date($format = 'Y-m-d', $max = 'now');
            $promotion24->end =  $faker->date($format = 'Y-m-d', $max = 'now');
            $promotion72->name = '72 ore di sponsorizzazione';
            $promotion72->price = '5.99';
            $promotion72->start =  $faker->date($format = 'Y-m-d', $max = 'now');
            $promotion72->end =  $faker->date($format = 'Y-m-d', $max = 'now');
            $promotion144->name = '144 ore di sponsorizzazione';
            $promotion144->price = '9.99';
            $promotion144->start =  $faker->date($format = 'Y-m-d', $max = 'now');
            $promotion144->end =  $faker->date($format = 'Y-m-d', $max = 'now');
            $promotion24->save();
            $promotion72->save();
            $promotion144->save();
    }
}
