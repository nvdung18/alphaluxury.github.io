<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RevTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp=date('Y-m-d H:i:s');
        for ($i=0; $i <20 ; $i++) { 
            # code...
            DB::table('_revenue_test')->insert([
                'revenue'=>59+$i,
                'quantity'=>5,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp
            ]);
        }
    }
}
