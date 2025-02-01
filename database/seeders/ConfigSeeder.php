<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        DB::table('percentage')->insert([
            'key' => 'deposit_fee',
            'value' => '2.5' // Default 2.5% fee
        ]);
    }
}
