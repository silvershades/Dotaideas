<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('shop_item_category_id')->constrained();
            $table->string('name');
            $table->string('description');
            $table->string('img_path')->nullable();
            $table->boolean('one_time_buy')->default(false);
            $table->integer('value')->default(0);
            $table->integer('charges')->default(1);
            $table->boolean('active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_items');
    }
}
