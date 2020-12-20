<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('type')->nullable(); // x-ray, profile, dental, social , documents
            $table->string('category')->nullable();
            $table->string('description')->nullable();
            $table->morphs('photoable');
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
        Schema::dropIfExists('photos');
    }
}
