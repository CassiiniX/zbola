<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->tinyInteger("star")->default(0);
            $table->text("description");
            $table->timestamps();

            $table->foreign("user_id")
              ->references("id")
              ->on("users"); 

            $table->foreign("product_id")
              ->references("id")
              ->on("products"); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
