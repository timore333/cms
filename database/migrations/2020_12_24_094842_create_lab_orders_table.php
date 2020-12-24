<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_orders', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_id')->index();
            $table->unsignedBigInteger('patient_id')->index();
            $table->unsignedBigInteger('user_id')->index();// doctor
            $table->string('job');
            $table->string('material');
            $table->string('shade');
            $table->string('description')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('lab_id')
                ->references('id')->on('labs')
                ->onDelete('cascade');

            $table->foreign('patient_id')
                ->references('id')->on('patients')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('lab_orders');
    }
}
