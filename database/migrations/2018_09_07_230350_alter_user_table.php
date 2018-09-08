<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('users', function($table)
    {
      // $table->renameColumn('name', 'last_name');
      $table->string('first_name');
      $table->char('account_type', 2)->after('first_name');
      $table->integer('org_id',false,true)->after('account_type')->length(11)->nullable();
      $table->char('is_admin', 1)->after('org_id');
      
      $table->string('id_number')->nullable();
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
