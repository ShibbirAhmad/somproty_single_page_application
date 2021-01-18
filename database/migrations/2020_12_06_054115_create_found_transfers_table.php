<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoundTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('found_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('from');
            $table->text('to');
            $table->float('amount');
            $table->integer('cost')->default(0);
            $table->integer('creator_admin');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('found_transfers');
    }
}
