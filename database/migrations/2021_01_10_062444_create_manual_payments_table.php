<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->bigInteger("invoice_id")->unsigned();
            $table->text("proof");
            $table->text("description");
            $table->enum("status",["failed","validasi","success"])->default("validasi");
            $table->timestamps();

            $table->foreign("user_id")
              ->references("id")
              ->on("users"); 

            $table->foreign("invoice_id")
              ->references("id")
              ->on("invoices"); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manual_payments');
    }
}
