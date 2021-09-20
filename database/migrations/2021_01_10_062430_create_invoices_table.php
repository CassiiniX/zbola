<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("product_id")->unsigned();
            $table->enum("status",["pending","payment","rejected","waiting","running","compeleted","failed","canceled"])->default("pending");
            $table->timestamp("start_rent")->useCurrent();
            $table->tinyInteger("hour")->default(1);
            $table->bigInteger("total")->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
