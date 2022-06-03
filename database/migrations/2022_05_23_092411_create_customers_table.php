<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',255)->nullable();
            $table->string('middle_name',255)->nullable();
            $table->string('last_name',255)->nullable();
            $table->enum('gender',['male','female','other'])->default('male');
            $table->string('marital_status')->nullable();
            $table->string('spouse_name',255)->nullable();
            $table->string('father_name',255)->nullable();
            $table->string('mother_name',255)->nullable();
            $table->decimal('mobile_no',10,0)->nullable();
            $table->decimal('alternate_mobile_no',10,0)->nullable();
            $table->string('email',255)->nullable();
            $table->date('dob')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->unsignedInteger('province_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('municipality_id')->nullable();
            $table->unsignedInteger('ward_no')->nullable();
            $table->string('village_name',255)->nullable();
            $table->string('full_address',255)->nullable();
            $table->string('documents',500)->nullable();
            $table->string('citizenship',500)->nullable();
            $table->string('citizenship_issue_date',500)->nullable();
            $table->string('citizenship_issue_district_id',500)->nullable();
            $table->string('nationality',500)->nullable();
            $table->string('citizenship_image',500)->nullable();
            $table->string('image',500)->nullable();
            $table->enum('status',['Pending','Approved','Rejected'])->default('Pending');
            $table->enum('is_active',['Active','Inactive'])->default('Active');
            $table->enum('is_deleted',['yes','no'])->default('no');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
