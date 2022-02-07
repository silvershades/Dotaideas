<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creeps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('post_id')->constrained();
            $table->foreignId('creep_type_id')->constrained();

            $table->string("name");

            $table->boolean("img_is_uploaded")->default(0);
            $table->string("img_path")->nullable();

            $table->smallInteger('roles_gold')->default(0);
            $table->smallInteger('roles_experience')->default(0);
            $table->smallInteger('roles_dominate')->default(0);
            $table->smallInteger('roles_early')->default(0);
            $table->smallInteger('roles_mid')->default(0);
            $table->smallInteger('roles_late')->default(0);
            $table->smallInteger('roles_armor')->default(0);
            $table->smallInteger('roles_magic_res')->default(0);
            $table->smallInteger('roles_status_res')->default(0);
            $table->smallInteger('damage_physical')->default(0);
            $table->smallInteger('damage_magical')->default(0);
            $table->smallInteger('damage_pure')->default(0);

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
        Schema::dropIfExists('creeps');
    }
}
