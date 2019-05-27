<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('games')->insert([
            ['key' => 'D&D35', 'name' => 'Dungeons and Dragons 3.5'],
            ['key' => 'D&D5', 'name' => 'Dungeons and Dragons 5.0'],
            ['key' => 'PATH1', 'name' => 'Pathfinder 1'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
