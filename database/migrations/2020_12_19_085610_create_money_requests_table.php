<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_requests', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->unsignedBigInteger('company_id')->index();
            $table->unsignedBigInteger('approval_id')->index();
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')->on('patients')
                ->onDelete('cascade');

            $table->foreign('approval_id')
                ->references('id')->on('approvals')
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
        Schema::dropIfExists('money_requests');
    }
}
