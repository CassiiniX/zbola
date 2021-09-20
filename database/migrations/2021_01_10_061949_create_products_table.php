<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text("address");
            $table->tinyInteger("star")->default(0);
            $table->text("description");
            $table->text("fasilitas");
            $table->text("quesation");            
            $table->bigInteger("price")->default(0);
            $table->boolean("rent")->default(false);
            $table->text("images");
            $table->enum("status",["active","nonactive"])->default("active");
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
        Schema::dropIfExists('products');
    }
}
