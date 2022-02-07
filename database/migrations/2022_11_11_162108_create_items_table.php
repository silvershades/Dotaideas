<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('post_id')->constrained();
            $table->foreignId('item_type_id')->constrained();
            $table->foreignId('item_shop_id')->constrained();

//            $table->string('type')->default("Basic");
//            $table->string('shop')->default("Home");

            $table->boolean("img_is_uploaded")->default(0);
            $table->string("img_path")->nullable();

            $table->string('name');

            //BASICS
            $table->integer('gold')->default(0);
            $table->float('bonus_strength')->default(0);
            $table->float('bonus_agility')->default(0);
            $table->float('bonus_intelligence')->default(0);
            $table->text('bonus_others')->nullable();
            $table->text('recipe')->nullable();

            //ROLES
            $table->smallInteger('roles_armor')->default(0);
            $table->smallInteger('roles_damage')->default(0);
            $table->smallInteger('roles_utility')->default(0);
            $table->smallInteger('roles_support')->default(0);
            $table->smallInteger('roles_siege')->default(0);
            $table->smallInteger('roles_heal')->default(0);
            $table->smallInteger('roles_mana')->default(0);
            $table->smallInteger('roles_disable')->default(0);
            $table->smallInteger('roles_resistance')->default(0);

            //DAMAGE OUTPUT
            $table->smallInteger('damage_pure')->default(0);
            $table->smallInteger('damage_physical')->default(0);
            $table->smallInteger('damage_magical')->default(0);

            //DESCRIPTION
            $table->text('description')->nullable();
            $table->text('lore')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
