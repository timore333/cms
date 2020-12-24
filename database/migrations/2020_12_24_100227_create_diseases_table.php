<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diseases', function(Blueprint $table) {
            $table->id();
            $table->string('type'); // systemic or dental
            $table->string('category')->nullable();
            $table->string('name');
            $table->text('definition')->nullable();
            $table->text('aetiology')->nullable(); // causes
            $table->text('conclusion')->nullable();
            $table->text('clinical_features')->nullable();
            $table->text('histopathologic_features')->nullable();
            $table->text('treatment')->nullable();
            $table->text('differential_diagnosis')->nullable();
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
        Schema::dropIfExists('diseases');
    }
}
