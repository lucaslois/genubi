<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('channel_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('character_id')->nullable();
            $table->unsignedInteger('npc_id')->nullable();
            $table->text('text');
            $table->boolean('is_roll')->default(false);
            $table->boolean('only_dm')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('channel_id')->references('id')->on('channels');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('npc_id')->references('id')->on('npcs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_posts');
    }
}
