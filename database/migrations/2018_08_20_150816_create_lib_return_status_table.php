<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibReturnStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_return_status', function (Blueprint $table) {
            $table->string('return_status_id');
            $table->string('return_status_desc');
  
            $table->primary('return_status_id');
        });

        DB::table('lib_return_status')
        ->insert([
            ['return_status_id' => 'OK','return_status_desc' => 'Okay'],
            ['return_status_id' => 'DM','return_status_desc' => 'Damaged'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_return_status');
    }
}
