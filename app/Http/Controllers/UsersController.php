<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Cambia el tipo de usuario de una publicacion
     * 
     * @param int $id
     * @param int $status
     * @return $message
     */
    public static function status($id,$status){
        $data = User::find($id);
        try {
            $data->status = $status;
            $data->save();
            $message = ["status" => true,"title" => "Exito" ,"message" => "La publicacion se modifico con exito", "class" => "bg-success", "icon" => "fas fa-check-circle"];
        } catch (\Throwable $th) {
            // throw $th;
            $message = ["status" => true,"title" => "Error" ,"message" => "No se pudo cambiar el estado <br> Porfavor vuelvalo a intentar", "class" => "bg-warning", "icon" => "fas fa-exclamation-triangle"];
        } finally{
            return redirect()->route('social.index')->with($message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
