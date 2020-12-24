<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedureVisitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_visit', function(Blueprint $table) {
            $table->unsignedBigInteger('visit_id')->index();
            $table->unsignedBigInteger('procedure_id')->index();
            $table->unsignedBigInteger('tooth_id')->index();
            $table->text('notes')->nullable();
            $table->boolean('completed')->default(false);

            $table->foreign('visit_id')
                ->references('id')->on('visits')
                ->onDelete('cascade');

            $table->foreign('procedure_id')
                ->references('id')->on('procedures')
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
        Schema::dropIfExists('procedure_visit');
    }
}
