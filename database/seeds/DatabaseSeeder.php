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
            ['name' => 'commonSerial',
                'value' => '1',
                'type' => 'serials'],
            ['name' => 'deptSerial',
                'value' => '1',
                'type' => 'serials'],
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
        ]);
    }
}
