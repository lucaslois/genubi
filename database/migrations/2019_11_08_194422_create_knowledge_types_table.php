<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowledgeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug');
            $table->string('name');
        });

        DB::table('knowledge_types')->insert([
            ['slug' => 'item', 'name' => 'Objeto'],
            ['slug' => 'npc', 'name' => 'Npc'],
            ['slug' => 'lore', 'name' => 'Lore'],
            ['slug' => 'location', 'name' => 'Locaciones'],
            ['slug' => 'creatures', 'name' => 'Criaturas'],
            ['slug' => 'buildings', 'name' => 'Edificios'],
            ['slug' => 'civilizations', 'name' => 'Civilizaciones'],
            ['slug' => 'notes', 'name' => 'Notas'],
            ['slug' => 'maps', 'name' => 'Mapas'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('knowledge_types');
    }
}
