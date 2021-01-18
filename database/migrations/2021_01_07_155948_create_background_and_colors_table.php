<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBackgroundAndColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('background_and_colors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('primary_color')->nullable();
            $table->text('primary_background_color')->nullable();
            $table->text('menu_background_color')->nullable();
            $table->text('sub_menu_background_color')->nullable();
            $table->text('primary_text_color')->nullable();
            $table->text('menu_text_color')->nullable();
            $table->text('sub_menu_text_color')->nullable();
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
        Schema::dropIfExists('background_and_colors');
    }
}
