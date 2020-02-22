<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        factory(App\Insurer::class, 30)->create();
        factory(App\Service::class, 20)->create();
        factory(App\Discount::class, 10)->create();
        factory(App\Beneficiary::class, 300)->create();
        factory(App\Invoice::class, 300)->create();
        factory(App\ItemCategory::class, 5)->create();
        factory(App\Item::class, 300)->create();
    }
}
