<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacterStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('color');
            $table->timestamps();
        });

        DB::table('character_states')->insert([
            ['name' => 'Activo', 'slug' => 'active', 'color' => '#79B4A9'],
            ['name' => 'Muerto', 'slug' => 'dead', 'color' => '#FE5D26'],
            ['name' => 'Abandonado', 'slug' => 'abandoned', 'color' => '#222725'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_states');
    }
}
