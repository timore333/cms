<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index(); // belongs to patient id
            $table->unsignedBigInteger('doctor_id')->index();  // belongs to doctor id
            $table->time('start'); // start time
            $table->time('end'); // end time
            $table->string('recall')->nullable(); // recall reason
            $table->string('status')->nullable(); // finished or not
            $table->timestamps();

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
        Schema::dropIfExists('visits');
    }
}
