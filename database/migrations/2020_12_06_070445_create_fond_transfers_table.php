<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFondTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fond_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('from');
            $table->text('to');
            $table->float('amount');
            $table->float('cost')->default(0);
            $table->text('creator_admin');
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
        Schema::dropIfExists('fond_transfers');
    }
}
