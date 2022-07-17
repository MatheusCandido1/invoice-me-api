<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;
use Carbon\Carbon;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'number' => 'BR7278632767000010005981352C1',
            'beneficiary' => 'MATHEUS CANDIDO CARVALHO
            CONSULTORIA EM TECNOLOGIA DA INFORMACAO LTDA',
            'bic_code' => 'OURIBRSPXXX',
            'company_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
