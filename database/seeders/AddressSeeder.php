<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use Carbon\Carbon;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'zipcode' => '31720-580',
            'state' => 'MG',
            'city' => 'Belo Horizonte',
            'neighborhood' => 'Planalto',
            'address' => 'Rua Epaminondas de Moura e Silva',
            'number' => '345',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
