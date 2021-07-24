<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'product_category_id' => Str::random(5),
            'product_category_name' => Str::random(10).'Namecategory',
            'product_type_id' => ProductType::inRandomOrder()->first()->product_type_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
