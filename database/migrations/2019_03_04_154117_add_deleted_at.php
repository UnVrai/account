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
        Schema::table('orders', function ($table) {
            $table->softDeletes();
        });
        Schema::table('debts', function ($table) {
            $table->softDeletes();
        });
        Schema::table('expenses', function ($table) {
            $table->softDeletes();
        });
        Schema::table('incomes', function ($table) {
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
        Schema::table('orders', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('debts', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('expenses', function ($table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('incomes', function ($table) {
            $table->dropColumn('deleted_at');
        });
    }
}
