<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Attribute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('attributes')) {
            Schema::create('attributes', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('identifier')->unique();
                $table->enum('field_type', [
                    'STRING', 'TEXT', 'SELECT',
                    'FILE', 'DATETIME','CHECKBOX','RADIO',
                ]);
                $table->integer('sort_order')->nullable()->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('attribute_dropdown_options')) {
            Schema::create('attribute_dropdown_options', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('attribute_id')->unsigned();
                $table->string('display_text');
                $table->timestamps();

                $table->foreign('attribute_id')
                    ->references('id')->on('attributes')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('product_attribute_values')) {
            Schema::create('product_attribute_values', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('attribute_id')->unsigned();
                $table->integer('product_id')->unsigned();
                $table->string('value');
                $table->timestamps();

                $table->foreign('attribute_id')
                    ->references('id')->on('attributes')->onDelete('cascade');
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
        Schema::drop('attributes');
        Schema::drop('attribute_dropdown_options');
        Schema::drop('product_attribute_values');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
