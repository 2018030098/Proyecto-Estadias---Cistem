<?php // Eliminar 

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class pruebasController extends Controller
{
    public function prueba(){
        return view('pruebas');
    }

    public function shows(Request $request){
        dd($_GET);
        dd($request);
    }
}
