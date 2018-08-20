<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductItemOutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_item_out', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_item_id',false,true);
            $table->date('request_date');
            $table->string('request_status_id',2);
            $table->integer('user_id',false,true);
            
            $table->integer('approved_by',false,true)->nullable();
            $table->date('approved_date')->nullable();
            $table->date('product_eta')->nullable();
            $table->date('product_return_date')->nullable();
            $table->string('return_status_id',2)->nullable();
            $table->string('remarks', 255)->nullable();
            
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
        Schema::dropIfExists('product_item_out');
    }
}
