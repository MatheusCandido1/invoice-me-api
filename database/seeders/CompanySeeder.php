<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'MATHEUS CANDIDO CARVALHO CONSULTORIA
            EM TECNOLOGIA DA INFORMACAO LTDA',
            'code' => '41.486.539/0001-80',
            'email' => 'matheus12bh@gmail.com',
            'phone' => '+55 (31) 9 9872 2520',
            'fantasy_name' => 'MATHEUS CANDIDO CARVALHO',
            'user_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
