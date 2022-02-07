<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDota2HeroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dota2_heroes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->string("json_name");

            $table->smallInteger('attack_type')->default(1);
            $table->smallInteger('complexity')->default(1);
            $table->integer('basic_value_hp')->default(200);
            $table->integer('basic_value_mana')->default(75);
            $table->float('basic_regen_hp')->default(0.25);
            $table->float('basic_regen_mana')->default(0);
            $table->smallInteger('primary_attribute')->default(1);
            $table->float('strength')->default(10);
            $table->float('agility')->default(10);
            $table->float('intelligence')->default(10);
            $table->float('lvlup_strength')->default(1);
            $table->float('lvlup_agility')->default(1);
            $table->float('lvlup_intelligence')->default(1);

            //STATS
            $table->integer('attack_damage_min')->default(0);
            $table->integer('attack_damage_max')->default(0);
            $table->float('attack_bat')->default(0);
            $table->float('attack_ias')->default(0);
//            $table->float('attack_point')->default(0);
//            $table->float('attack_backswing')->default(0);
            $table->float('attack_range')->default(0);
            $table->float('attack_projectile_speed')->default(0);
            $table->float('defense_armor')->default(0);
            $table->float('defense_magic_resistance')->default(0);
            $table->integer('mobility_speed')->default(0);
            $table->float('mobility_turn_rate')->default(0);
            $table->integer('mobility_vision_day')->default(0);
            $table->integer('mobility_vision_night')->default(0);

            //ROLES
            $table->smallInteger('roles_carry')->default(0);
            $table->smallInteger('roles_support')->default(0);
            $table->smallInteger('roles_nuker')->default(0);
            $table->smallInteger('roles_disabler')->default(0);
            $table->smallInteger('roles_jungler')->default(0);
            $table->smallInteger('roles_durable')->default(0);
            $table->smallInteger('roles_escape')->default(0);
            $table->smallInteger('roles_pusher')->default(0);
            $table->smallInteger('roles_initiator')->default(0);

            //STRENGTHS
            $table->smallInteger('strengths_team_fight')->default(0);
            $table->smallInteger('strengths_farm')->default(0);
            $table->smallInteger('strengths_split_push')->default(0);
            $table->smallInteger('strengths_siege')->default(0);
            $table->smallInteger('strengths_base_defense')->default(0);
            $table->smallInteger('strengths_roshan')->default(0);

            //DAMAGE OUTPUT
            $table->smallInteger('damage_pure')->default(0);
            $table->smallInteger('damage_physical')->default(0);
            $table->smallInteger('damage_magical')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dota2_heroes');
    }
}
