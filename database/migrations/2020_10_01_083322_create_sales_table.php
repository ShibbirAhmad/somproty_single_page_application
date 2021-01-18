<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('sale_type'); //1=office sale, 2=company_sale
            $table->integer('company_id')->nullable()->comment('form_company_table');
            $table->integer('paid_by');   //1=cash 2=bKash 3=bank
            $table->integer('status')->default(1);    //1=sale initial 2=sale paid  3==sale returnred
            $table->text('name')->nullable();
            $table->text('mobile_no')->nullable();
            $table->text('address')->nullable();
            $table->text('invoice_no')->nullable();
            $table->float('total');
            $table->float('paid');
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
