<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('scientific_name')->nullable();
            $table->string('form')->nullable();
            $table->string('use')->nullable();
            $table->string('dose')->nullable();
            $table->string('concentration')->nullable();
            $table->string('price')->nullable();
            $table->text('indications')->nullable();
            $table->text('precautions')->nullable();
            $table->string('company')->nullable();
            $table->text('pamphlet')->nullable();
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
        Schema::dropIfExists('drugs');
    }
}
