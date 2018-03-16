<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('order','csSf');
            $table->renameColumn('debt','gfsSf');
            $table->renameColumn('income','xsSf');
            $table->renameColumn('expense','msSf');
            $table->dropColumn('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('csSf', 'order');
            $table->renameColumn('gfsSf', 'debt');
            $table->renameColumn('xsSf', 'income');
            $table->renameColumn('msSf', 'expense');
            $table->float('total')->default(0);
        });
    }
}
