<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaseMastersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PurchaseMasters', function(Blueprint $table) {
            $table->increments('id');
            $table->string('vendor_id');
			$table->string('purchaseDate');
			$table->string('purchaseTotalPrice');
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
        Schema::drop('PurchaseMasters');
    }

}
