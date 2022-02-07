<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShopItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shop_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('shop_item_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('consumed_on_post')->unsigned()->nullable();
            $table->dateTime('consumed_on_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_shop_items');
    }
}
