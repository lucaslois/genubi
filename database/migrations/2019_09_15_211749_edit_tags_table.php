<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->string('taggable_type');
            $table->unsignedBigInteger('taggable_id');
            $table->string('name')->change();
            $table->unsignedBigInteger('campaign_id')->nullable()->change();
            $table->string('tag');
            $table->boolean('active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('taggable_type');
            $table->dropColumn('taggable_id');
            $table->dropColumn('tag');
            $table->unsignedBigInteger('name')->change();
            $table->dropColumn('active');
        });
    }
}
