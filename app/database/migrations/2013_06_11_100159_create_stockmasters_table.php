<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStockMastersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('StockMasters', function(Blueprint $table) {
            $table->increments('id');
            $table->string('product_id');
			$table->string('quantityInOut');
			$table->string('entryDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('StockMasters');
    }

}
