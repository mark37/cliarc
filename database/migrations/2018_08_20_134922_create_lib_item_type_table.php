<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLibItemTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lib_item_type', function (Blueprint $table) {
            $table->string('type_id');
            $table->string('type_desc');
  
            $table->primary('type_id');
        });

        DB::table('lib_item_type')
        ->insert([
            ['type_id' => 'BD','type_desc' => 'Building/Venue'],
            ['type_id' => 'MC','type_desc' => 'Vehicle'],
            ['type_id' => 'EQ','type_desc' => 'Equipment'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lib_item_type');
    }
}
