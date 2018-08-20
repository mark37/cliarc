<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibRequestStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_request_status', function (Blueprint $table) {
            $table->string('request_status_id');
            $table->string('request_status_desc');
  
            $table->primary('request_status_id');
        });

        DB::table('lib_request_status')
        ->insert([
            ['request_status_id' => 'RQ','request_status_desc' => 'Requested'],
            ['request_status_id' => 'AP','request_status_desc' => 'Approved'],
            ['request_status_id' => 'AQ','request_status_desc' => 'Acquired'],
            ['request_status_id' => 'RT','request_status_desc' => 'Returned'],
            ['request_status_id' => 'MS','request_status_desc' => 'Missing']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_request_status');
    }
}
