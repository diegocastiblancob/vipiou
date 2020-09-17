<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('reference_sale');
            $table->string('value');
            $table->string('state_pol');
            $table->string('response_code_pol');
            $table->string('payment_method_type');
            $table->string('currency');
            $table->string('payment_method_id');
            $table->string('response_message_pol');
            $table->string('email_buyer');
            $table->string('cus');
            $table->string('date');
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
        Schema::dropIfExists('payments');
    }
}
