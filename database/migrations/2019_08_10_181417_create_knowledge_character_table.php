<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeCharacterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_character', function (Blueprint $table) {
            $table->unsignedInteger('character_id');
            $table->unsignedInteger('knowledge_id');

            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('knowledge_id')->references('id')->on('knowledges');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knowledge_user');
    }
}
