<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDebtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debts', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name');
            $table->char('number');
            $table->integer('price');
            $table->float('total');
            $table->float('actual');
            $table->char('person');
            $table->char('qkr')->nullable();
            $table->char('sponsor')->nullable();
            $table->char('people')->nullable();
            $table->integer('debtor_id');
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
        Schema::dropIfExists('debts');
    }
}
