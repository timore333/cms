<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signables', function(Blueprint $table) {
            $table->unsignedBigInteger('sign_id')->index();
            $table->unsignedBigInteger('signable_id')->index();
            $table->string('signable_type');
            $table->timestamps();

            $table->foreign('sign_id')
                ->references('id')->on('signs')
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
        Schema::dropIfExists('signables');
    }
}
