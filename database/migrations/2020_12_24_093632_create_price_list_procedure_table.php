<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_list_procedure', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price_list_id')->index();
            $table->unsignedBigInteger('procedure_id')->index();
            $table->string('price');
            $table->string('code')->nullable();
            $table->timestamps();

            $table->foreign('price_list_id')
                ->references('id')->on('price_lists')
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
        Schema::dropIfExists('price_list_procedure');
    }
}
