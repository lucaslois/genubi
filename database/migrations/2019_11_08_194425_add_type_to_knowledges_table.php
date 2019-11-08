<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToKnowledgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('knowledges', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable();

            $table->foreign('type_id')->references('id')->on('knowledge_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('knowledges', function (Blueprint $table) {
            $table->dropForeign(['type_id']);

            $table->dropColumn('type_id');
        });
    }
}
