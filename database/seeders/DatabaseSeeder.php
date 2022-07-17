<?php

namespace Database\Seeders;

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
        $this->call(UserSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(InvoiceSeeder::class);
    }
}
