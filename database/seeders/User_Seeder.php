<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'kind_Id' => '1',
            'email' => 'admin@admin',
            'password' => '$2y$10$yOwV6iFXQsaL4rdxZHBcvOMXCHR0K3waPAY/ht17PnR4MxhImvw.O',
            'status' => '1',
            'created_at' => '2021-01-01 00:00:00',
            'updated_at' => '2021-01-01 00:00:00'
        ]);
    }
}
