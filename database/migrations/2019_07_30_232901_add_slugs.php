<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('characters', function(Blueprint $table) {
            $table->string('slug')->nullable();
        });
        Schema::table('npcs', function(Blueprint $table) {
            $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('characters', function(Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('npcs', function(Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
