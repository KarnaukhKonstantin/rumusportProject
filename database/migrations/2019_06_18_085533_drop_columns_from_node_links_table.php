<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnsFromNodeLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('node_links', function (Blueprint $table) {
            $table->dropColumn('node_id_1');
            $table->dropColumn('node_id_2');
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
            $table->integer('node_id_1');
            $table->integer('node_id_2');
        });
    }
}
