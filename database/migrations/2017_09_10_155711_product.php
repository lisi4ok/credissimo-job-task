<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * @todo  prices more good
         * @todo  inventory validation
         */
        if (!Schema::hasTable('products')) {
            Schema::create('products', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable()->default(null);
                $table->string('slug')->nullable()->default(null);
                $table->string('sku')->nullable()->default(null);
                $table->text('description')->nullable()->default(null);
                $table->decimal('price', 10, 6);
                // $table->tinyInteger('status')->nullable()->default(null);
                // $table->tinyInteger('in_stock')->nullable()->default(null);
                // $table->tinyInteger('track_stock')->nullable()->default(null);
                // $table->decimal('qty', 10, 6)->nullable();
                $table->timestamps();
            });
        }

        // Schema::create('product_prices' , function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('product_id')->unsigned();
        //     $table->decimal('price', 10, 6);
        //     $table->decimal('special_price', 10, 6);
        //     $table->decimal('final_price', 10, 6);
        //     $table->timestamps();
        //     $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        // });

        if (!Schema::hasTable('product_images')) {
            Schema::create('product_images', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('product_id')->unsigned();
                $table->text('path');
                $table->boolean('is_main_image')->nullable()->default(null);
                $table->timestamps();
                $table->foreign('product_id')->references('id')
                    ->on('products')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('category_product')) {
            Schema::table('category_product', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')
                    ->on('products')->onDelete('cascade');
            });
        }
        if (Schema::hasTable('product_attribute_values')) {
            Schema::table('product_attribute_values', function (Blueprint $table) {
                $table->foreign('product_id')
                    ->references('id')->on('products')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('products');
        Schema::drop('product_images');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
