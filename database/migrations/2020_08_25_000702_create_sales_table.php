<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('sale_target');
            $table->date('sale_date');
            $table->text('sale_description');
            $table->string('sale_price');
            $table->string('sale_credit');
            $table->string('initial_fee');
            $table->string('no_fees');
            $table->string('financed_price');
            $table->string('sale_status');
            $table->string('sale_file');
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
        Schema::dropIfExists('sales');
    }
}
