<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $timestamp=date('Y-m-d H:i:s');
        for ($i=0; $i <20 ; $i++) { 
            # code...
            DB::table('product')->insert([
                'name'=>'product'.$i+1,
                'price'=>59+$i,
                'rating'=>5,
                'created_at'=>$timestamp,
                'updated_at'=>$timestamp
            ]);
        }
    }
}
