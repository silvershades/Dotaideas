<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMrcSpellAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mrc_spell_attributes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('mrc_spell_id')->constrained();
            $table->string("name");
            $table->string("value");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mrc_spell_attributes');
    }
}
