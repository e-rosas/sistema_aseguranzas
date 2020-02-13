<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        //factory(App\Insurance::class, 30)->create();
        //factory(App\Service::class, 50)->create();
        //factory(App\Discount::class, 3)->create();
        factory(App\Beneficiary::class, 300)->create();
    }
}
