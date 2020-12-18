<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeethTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teeth', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('uns_number'); // Universal Numbering System .
            $table->string('side');
            $table->string('type');// perminant or decedous
            $table->unsignedBigInteger('patient_id')->index(); // belongs to patient id

            $table->foreign('patient_id')
                ->references('id')->on('patients')
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
        Schema::dropIfExists('teeth');
    }
}
