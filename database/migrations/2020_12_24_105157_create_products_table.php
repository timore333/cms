<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dental_company_id')->index();
            $table->unsignedBigInteger('product_category_id')->index();
            $table->string('name');
            $table->string('form');
            $table->string('unit');
            $table->string('package');
            $table->unsignedBigInteger('amount');
            $table->text('description')->nullable();
            $table->string('uses')->nullable();
            $table->timestamps();

            $table->foreign('dental_company_id')
                ->references('id')->on('dental_companies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
