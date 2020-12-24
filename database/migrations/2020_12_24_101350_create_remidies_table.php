<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemidiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remidies', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('drug_id')->index();
            $table->unsignedBigInteger('prescription_id')->index();
            $table->string('drug_name');
            $table->string('dose');
            $table->string('concentration');
            $table->string('duration');
            $table->string('form');
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->foreign('drug_id')
                ->references('id')->on('drugs')
                ->onDelete('cascade');

            $table->foreign('prescription_id')
                ->references('id')->on('prescriptions')
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
        Schema::dropIfExists('remidies');
    }
}
