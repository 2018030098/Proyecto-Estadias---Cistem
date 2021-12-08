<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class statusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'id' => '1',
            'status' => 'activo',
            'description' => 'estado en el cual se encuentra un registro mientras este activo'
        ]);
        DB::table('status')->insert([
            'id' => '2',
            'status' => 'eliminado',
            'description' => 'estado en el cual se encuentra un registro al ser eliminado'
        ]);
        DB::table('status')->insert([
            'status' => 'inactivo',
            'description' => 'estado en el cual se encuentra un registro al ser eliminado o completado'
        ]);

        DB::table('status')->where('id','=','3')->update(['id' => '0']);
    }
}
