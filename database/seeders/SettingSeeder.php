<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'logo1' => '/images/logo1.png',
            'logo2' => '/images/logo2.png',
            'title' => ':: SAB O & G :: ',
            'name' => 'SAB O & G',
            'email' => 'sab@codingcrust.com',
        ]);
    }
}
