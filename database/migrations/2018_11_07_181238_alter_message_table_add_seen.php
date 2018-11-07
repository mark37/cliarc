<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessageTableAddSeen extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('messages', function($table)
    {
      $table->char('seen_flag', 1)->after('size');
      $table->dateTime('schedule_end_time')->after('seen_flag');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('messages', function (Blueprint $table) {
      $table->dropColumn('seen_flag');
      $table->dropColumn('schedule_end_time');
    });
  }
}
