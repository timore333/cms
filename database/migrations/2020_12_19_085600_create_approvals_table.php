<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_request_id')->index();
            $table->unsignedBigInteger('number');
            $table->string('status'); // approved or dednied
            $table->unsignedDecimal('patient_share')->default(0);
            $table->unsignedDecimal('max_limit')->nullable();
            $table->unsignedDecimal('total');
            $table->text('approved')->nullable();
            $table->timestamps();

            $table->foreign('service_request_id')
                ->references('id')->on('service_requests')
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
        Schema::dropIfExists('approvals');
    }
}
