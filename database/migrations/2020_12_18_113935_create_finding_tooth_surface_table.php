<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindingToothSurfaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finding_tooth_surface', function(Blueprint $table) {
            $table->unsignedBigInteger('finding_id')->index();
            $table->unsignedBigInteger('tooth_surface_id')->index();

            $table->foreign('finding_id')
                ->references('id')->on('findings')
                ->onDelete('cascade');

            $table->foreign('tooth_surface_id')
                ->references('id')->on('tooth_surfaces')
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
        Schema::dropIfExists('finding_tooth_surface');
    }
}
