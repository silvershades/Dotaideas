<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('item_id')->constrained();
            $table->string("key")->nullable();
            $table->string("value")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_attributes');
    }
}
