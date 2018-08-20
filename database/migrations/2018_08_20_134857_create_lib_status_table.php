<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_status', function (Blueprint $table) {
            $table->string('status_id');
            $table->string('status_desc');
  
            $table->primary('status_id');
        });

        DB::table('lib_status')
        ->insert([
            ['status_id' => 'OK','status_desc' => 'Functional'],
            ['status_id' => 'NF','status_desc' => 'Not Functional'],
            ['status_id' => 'FR','status_desc' => 'For Repair']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_status');
    }
}
