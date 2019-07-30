<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreDataToCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->text('desc_mentality')->nullable();
            $table->text('desc_appearance')->nullable();
            $table->text('desc_social_status')->nullable();
            $table->text('famous_phrase')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn('desc_mentality');
            $table->dropColumn('desc_appearance');
            $table->dropColumn('desc_social_status');
            $table->dropColumn('famous_phrase');
        });
    }
}
