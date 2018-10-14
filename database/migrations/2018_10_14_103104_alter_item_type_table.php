<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterItemTypeTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    \App\LibStatus::query()->delete();

    DB::table('lib_status')
    ->insert([
        ['status_id' => 'OK','status_desc' => 'Available'],
        ['status_id' => 'NF','status_desc' => 'Not Available'],
    ]);
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
      //
  }
}
