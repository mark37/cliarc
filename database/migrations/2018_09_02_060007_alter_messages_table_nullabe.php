<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMessagesTableNullabe extends Migration
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
      $table->text('message')->nullable()->change();
      $table->string('filename')->after('message')->nullable()->change();
      $table->string('mime')->after('filename')->nullable()->change();
      $table->string('path')->after('mime')->nullable()->change();
      $table->integer('size')->after('path')->nullable()->change();
    });
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
