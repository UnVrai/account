<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->char('date');
            $table->char('type');
            $table->float('csNum')->default(0);
            $table->float('gfsNum')->default(0);
            $table->float('xsNum')->default(0);
            $table->float('msNum')->default(0);
            $table->float('order')->default(0);
            $table->float('debt')->default(0);
            $table->float('income')->default(0);
            $table->float('expense')->default(0);
            $table->float('total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
