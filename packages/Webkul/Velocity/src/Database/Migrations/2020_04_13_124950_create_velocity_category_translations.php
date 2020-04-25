<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVelocityCategoryTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('velocity_category_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('category_id')->unsigned()->nullable();
            // $table->foreign('category_id')->references('id')->on('velocity_category')->onDelete('cascade');
            $table->text('products')->nullable();

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
        Schema::dropIfExists('velocity_category_translations');
    }
}
