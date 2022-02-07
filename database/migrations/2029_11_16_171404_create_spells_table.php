<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spells', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('post_id')->constrained();
            $table->foreignId('spell_type_id')->constrained();
            $table->foreignId('spell_target_id')->constrained();
            $table->foreignId('spell_damage_type_id')->constrained();

            $table->unsignedInteger('creep_unit_id')->nullable();

            //GENERAL
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->boolean("img_is_uploaded")->default(0);
            $table->string("img_path")->nullable();
            $table->string("hotkey")->nullable();

            $table->string('manacost')->default(0);
            $table->string('cooldown')->default(0);

            //MODIFIERS
            $table->boolean("mod_by_aghanims_scepter")->default(false);
            $table->text("mod_by_aghanims_scepter_desc")->nullable();
            $table->boolean("mod_by_aghanims_shard")->default(false);
            $table->text("mod_by_aghanims_shard_desc")->nullable();
            $table->boolean("created_by_aghanims_scepter")->default(false);
            $table->boolean("created_by_aghanims_shard")->default(false);
            $table->boolean("pierces_bkb")->default(false);
            $table->boolean("dispellable")->default(false);
            $table->boolean("breakable")->default(false);
            $table->boolean("blocked_by_linkens")->default(false);
            $table->boolean("cast_while_rooted")->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spells');
    }
}
