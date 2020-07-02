<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // PRIMO DB:SEED
        $this->call(PromotionsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);

        // SECONDO DB:SEED
        $this->call(UsersTableSeeder::class);

        // TERZO DB:SEED
        $this->call(HousesTableSeeder::class);

        // QUARTO DB:SEED
        $this->call(MessagesTableSeeder::class);
        $this->call(PhotosTableSeeder::class);

    }
}
