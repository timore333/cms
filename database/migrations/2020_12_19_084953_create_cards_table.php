<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function(Blueprint $table) {
            $table->id();
            $table->string('card_id');
            $table->string('insurance_no')->nullable();
            $table->unsignedBigInteger('company_id')->index();
            $table->unsignedBigInteger('patient_id')->index();
            $table->date('effective')->nullable();
            $table->date('expiry')->nullable();
            $table->unsignedInteger('deductible')->default(0);
            $table->string('co_ins')->nullable();
            $table->string('job_company')->nullable();
            $table->string('policy_holder')->nullable();
            $table->string('network')->nullable();
            $table->string('category')->nullable();
            $table->string('dental')->nullable();
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')->on('companies')
                ->onDelete('cascade');

            $table->foreign('patient_id')
                ->references('id')->on('patients')
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
        Schema::dropIfExists('cards');
    }
}
