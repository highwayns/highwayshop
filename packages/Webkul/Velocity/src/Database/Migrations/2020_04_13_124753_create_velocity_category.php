<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVelocityCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('velocity_category', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('category_id')->unsigned()->nullable();

            $table->integer('category_menu_id')->unsigned()->nullable();

            $table->text('icon')->nullable();

            $table->string('tooltip', 100)->nullable();
            
            $table->boolean('status')->default(0);

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
        Schema::dropIfExists('velocity_category');
    }
}
