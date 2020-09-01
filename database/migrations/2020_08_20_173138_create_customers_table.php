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
            $table->foreignId('user_id')->constrained();
            $table->string('name_customer');
            $table->string('lastname_customer');
            $table->string('identification_customer');
            $table->string('city_customer');
            $table->string('address_customer');
            $table->string('phone_customer');
            $table->string('email_customer')->unique();
            $table->string('company_customer')->nullable();
            $table->string('website_customer')->nullable();
            $table->string('status_customer');
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
