<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessageTableAddFile extends Migration
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
      $table->string('r_user_id')->after('user_id');
      $table->string('filename')->after('message');
      $table->string('mime')->after('filename');
      $table->string('path')->after('mime');
      $table->integer('size')->after('path');
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
      $table->dropColumn('r_user_id');
      $table->dropColumn('filename');
      $table->dropColumn('mime');
      $table->dropColumn('path');
      $table->dropColumn('size');
    });
  }
}
