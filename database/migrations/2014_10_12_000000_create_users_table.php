<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('born_rights')->default('mortal');
            $table->string('google_id')->nullable();
            $table->string('steam_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('di_avatar')->default('/img/shop_items/avatars/avatar_default.jpg');
            $table->string('role')->default("USER");
            $table->string('ip')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('img_is_uploaded')->default(false);
            $table->string('img_path')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
