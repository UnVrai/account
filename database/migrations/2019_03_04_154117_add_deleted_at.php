<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('debts', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('incomes', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('debts', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
