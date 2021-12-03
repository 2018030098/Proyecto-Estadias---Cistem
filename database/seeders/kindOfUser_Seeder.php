<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kindOfUser_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kindofusers')->insert([
            'kind' => 'admin',
            'description' => 'usuario con mayor poder dentro de la aplicacion'
        ]);
        DB::table('kindofusers')->insert([
            'kind' => 'user',
            'description' => 'usuario similar a admin, pero de menor poder'
        ]);
        DB::table('kindofusers')->insert([
            'kind' => 'client',
            'description' => 'usuario de menor poder, y el cual solo puede realizar acciones basicas dentro del a aplicacion'
        ]);
    }
}
