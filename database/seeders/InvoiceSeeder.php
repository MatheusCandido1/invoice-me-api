<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invoice::create([
            'key' => '#00007',
            'description' => 'Services delivered in relation to Dynaccurate between July 1st and July 31st',
            'fee' => '5',
            'brl' => 0.18398,
            'euro' => 5.43524,
            'duty' => 230.00,
            'subtotal' => 4600.00,
            'total' => 4830.00,
            'quote_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => 0,
            'company_id' => 1,
            'customer_id' => 1,
            'account_id' => 1,
        ]);
    }
}
