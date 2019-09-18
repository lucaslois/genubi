<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteColumnsToKnowledgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('knowledges_characters');

        Schema::table('knowledges', function (Blueprint $table) {
            $table->dropColumn('campaign_id');
            $table->dropColumn('user_id');
            $table->dropColumn('name');
            $table->dropColumn('text');
            $table->dropColumn('share_everyone');
            $table->dropColumn('is_official');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
