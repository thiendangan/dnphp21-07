<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_type')->insert([
            'product_type_id' => Str::random(4),
            'product_type_name' => Str::random(10).'Name',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
