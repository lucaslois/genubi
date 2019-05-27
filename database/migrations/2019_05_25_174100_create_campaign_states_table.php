<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('color');
            $table->timestamps();
        });

        DB::table('campaign_states')->insert([
            ['name' => 'Activo', 'slug' => 'active', 'color' => '#005500'],
            ['name' => 'Finalizada', 'slug' => 'finished', 'color' => '#005500'],
            ['name' => 'Abandonada', 'slug' => 'abandoned', 'color' => '#005500'],
            ['name' => 'Cancelada', 'slug' => 'cancelled', 'color' => '#005500'],
            ['name' => 'Inactiva', 'slug' => 'inactive', 'color' => '#005500'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_states');
    }
}
