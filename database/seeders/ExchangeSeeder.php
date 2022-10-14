<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exchange')->insert([
            [
                'exchange'  => 'NIFTY',
                'quantity'  => 50
            ],
            [
                'exchange'  => 'BANKNIFTY',
                'quantity'  => 25
            ],
        ]);
    }
}
