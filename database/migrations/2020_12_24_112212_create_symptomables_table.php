<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSymptomablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('symptomables', function(Blueprint $table) {
            $table->unsignedBigInteger('symptom_id')->index();
            $table->unsignedBigInteger('symptomable_id');
            $table->string('symptomable_type');

            $table->foreign('symptom_id')
                ->references('id')->on('symptoms')
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
        Schema::dropIfExists('symptomables');
    }
}
