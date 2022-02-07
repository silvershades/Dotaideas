<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreepUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creep_units', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('creep_id')->constrained();

            $table->string("name");
            $table->text("description")->nullable();
            $table->integer("kill_gold")->default(1);
            $table->integer("kill_exp")->default(1);
            $table->integer("total_hp")->default(1);
            $table->integer("total_hp_regen")->default(1);
            $table->integer("total_mana")->default(1);
            $table->integer("total_mana_regen")->default(1);
            $table->integer("units_in_camp")->default(1);

            $table->smallInteger('attack_type')->default(1);
            $table->integer('attack_damage_min')->default(5);
            $table->integer('attack_damage_max')->default(10);
            $table->float('attack_time')->default(0);
            $table->float('attack_range')->default(0);

            $table->integer('defense_armor')->default(0);
            $table->integer('defense_magic_resistance')->default(25);
            $table->integer('defense_status_resistance')->default(0);

            $table->integer('mobility_speed')->default(250);
            $table->float('mobility_turn_rate')->default(0.5);
            $table->integer('mobility_vision_day')->default(800);
            $table->integer('mobility_vision_night')->default(800);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creep_units');
    }
}
