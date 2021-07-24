<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->string('product_id',20);
            $table->primary('product_id');
            $table->string('product_name',200);
            $table->double('product_price',20);
            $table->string('product_image',200);
            $table->string('product_description',200)->nullable();
            $table->string('product_category_id',20);
            $table->foreign('product_category_id')->references('product_category_id')->on('category')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
