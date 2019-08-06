<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataToNpcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('npcs', function (Blueprint $table) {
            $table->string('family')->nullable();
            $table->string('race')->nullable();
            $table->string('age')->nullable();
            $table->string('desc_mentality')->nullable();
            $table->string('desc_appearance')->nullable();
            $table->string('desc_social_status')->nullable();
            $table->string('famous_phrase')->nullable();
            $table->string('nationality')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('npcs', function (Blueprint $table) {
            $table->dropColumn('family');
            $table->dropColumn('race');
            $table->dropColumn('age');
            $table->dropColumn('desc_mentality');
            $table->dropColumn('desc_appearance');
            $table->dropColumn('desc_social_status');
            $table->dropColumn('famous_phrase');
            $table->dropColumn('nationality');
        });
    }
}
