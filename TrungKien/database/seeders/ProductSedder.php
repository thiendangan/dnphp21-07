<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'product_id' => Str::random(5),
            'product_name' => 'Product'.Str::random(3),
            'product_price' => "120000",
            'product_description' => 'San pham tot',
            'product_image' => '1',
            'product_category_id' => Category::inRandomOrder()->first()->product_category_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
