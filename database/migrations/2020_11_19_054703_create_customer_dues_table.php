<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_dues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sale_id');
            $table->text('customer_mobile_no');
            $table->text('customer_name');
            $table->integer('amount');
            $table->integer('status')->default(0); //status 1=paid 0=unpaid
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
        Schema::dropIfExists('customer_dues');
    }
}
