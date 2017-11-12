<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('common')->insert([
            ['name' => 'msPrice',
                'value' => '45',
                'type' => 'price'],
            ['name' => 'csPrice',
                'value' => '70',
                'type' => 'price'],
            ['name' => 'gfsPrice',
                'value' => '70',
                'type' => 'price'],
            ['name' => 'xsPrice',
                'value' => '70',
                'type' => 'price'],
            ['name' => '日常支出',
                'value' => '0',
                'type' => 'expenseType'],
            ['name' => '工资',
                'value' => '0',
                'type' => 'expenseType'],
            ['name' => '借款',
                'value' => '1',
                'type' => 'expenseType'],
        ]);
    }
}
