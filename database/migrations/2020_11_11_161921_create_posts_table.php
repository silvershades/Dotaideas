<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('post_type_id')->constrained();
            $table->boolean("is_mrc")->default(0);
            $table->dateTime("is_published")->nullable();
            $table->boolean("is_active")->default("0");
            $table->boolean("is_flagged")->default("0");
            $table->string("flag_reason")->nullable();
            $table->boolean("is_pinned")->default("0");
            $table->bigInteger("views")->default("0");
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
        Schema::dropIfExists('posts');
    }
}
