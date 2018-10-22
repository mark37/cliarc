<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductType extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::table('lib_item_type')
    ->insert([
        ['type_id' => 'BP','type_desc' => 'Nursery Plants'],
        ['type_id' => 'MS','type_desc' => 'Mushrooms'],
        ['type_id' => 'CK','type_desc' => 'Cookies'],
        ['type_id' => 'JM','type_desc' => 'Jams'],
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
