<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->index();
            $table->unsignedBigInteger('company_id')->index();
            $table->string('request_no');
            $table->string('past_medical_history')->nullable();
            $table->string('chief_complaint')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('duration_of_sickness')->nullable();
            $table->string('drugs')->nullable(); // will be improved later to have the prescription id
            $table->string('lab')->nullable();
            $table->string('radiology')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')->on('patients')
                ->onDelete('cascade');

            $table->foreign('company_id')
                ->references('id')->on('companies')
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
        Schema::dropIfExists('service_requests');
    }
}
