<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function(Blueprint $table) {
            $table->id();
            $table->text('patient');
            $table->dateTimeTz('start');
            $table->dateTimeTz('end');
            $table->text('doctor');
            $table->string('color');
            $table->string('allDay');
            $table->string('status')->nullable();// waitng or attending or done
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('calendars');
    }
}
