<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToothSurfacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tooth_surfaces', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('tooth_id')->index();

            $table->foreign('tooth_id')
                ->references('id')->on('teeth')
                ->onDelete('cascade');
    });
}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public
function down()
{
    Schema::dropIfExists('tooth_surfaces');
}
}
