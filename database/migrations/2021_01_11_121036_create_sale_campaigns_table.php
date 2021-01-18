<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->date('expired_date');
            $table->text('background_color')->nullable();
            $table->text('border_color')->nullable();
            $table->text('border_width')->nullable();
            $table->integer('order_by');
            $table->integer('status');
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
        Schema::dropIfExists('sale_campaigns');
    }
}
