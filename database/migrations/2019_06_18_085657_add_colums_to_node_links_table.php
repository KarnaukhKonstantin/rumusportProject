<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsToNodeLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('node_links', function (Blueprint $table) {
            $table->integer('sid');
            $table->integer('tid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('node_links', function (Blueprint $table) {
            $table->dropColumn('sid');
            $table->dropColumn('tid');
        });
    }
}
