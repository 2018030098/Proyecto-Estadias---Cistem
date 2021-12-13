<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $data = $request->all();
        $auth = auth()->user();
        try {
            if(Hash::check($data['modal_adminPassword'],$auth->password)){
                $emails = DB::table('users')->get('email');

                $value = 0;
                foreach ($emails as $email) { // validar que no se repitan los emails
                    if ($email->email == $data['modal_email']) {
                        $value++;
                    }
                }
                if ($value == 0) {
                    $data = [
                        'kind_Id' => '2',
                        'name' => $data['modal_username'],
                        'email' => $data['modal_email'],
                        'password' => Hash::make($data['modal_password']),
                        'status' => '1'
                    ];
                    $newUser = (User::create($data));
                    UsersController::kind($newUser->id,'2');
                    $message = ["status" => true,"title" => "Usuario Creado" ,"message" => "se creo satisfactoriamente el nuevo usuario de tipo user", "class" => "bg-success", "icon" => "fas fa-check-circle"];
                } else {
                    $message = ["status" => true,"title" => "Correo repetido" ,"message" => "No se pudo crear el nuevo usuario debido a que el correo ya existe", "class" => "bg-warning", "icon" => "fas fa-exclamation-circle"];
                }
            }else {
                $message = ["status" => true,"title" => "Error" ,"message" => "La contraseña no es correcta", "class" => "bg-warning", "icon" => "fas fa-exclamation-triangle"];
            }
        } catch (\Throwable $th) {
            $message = ["status" => true,"title" => "Error" ,"message" => "hubo un problema al intentar crear el nuevo usuario", "class" => "bg-danger", "icon" => "fas fa-exclamation-triangle"];
            throw $th;
        } finally {
            return redirect()->route('profile.show')->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $email
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        if ($email == auth()->user()->email) {
            return redirect()->route('profile.show');
        }else{
            $data = DB::table('users')->where('email','=',$email)->get();
            $data = $data['0'];
            $kind = DB::table('kindofusers')->where('id','=',$data->kind_Id)->get();
            $kind = $kind['0'];
            
            $user = [
                "name" => $data->name,
                "email" => $data->email,
                "profile_photo_path" => $data->profile_photo_path,
                "kind" => $kind->kind
            ];
            // dd($user); // visualizar que informacion se envia a la vista
            return view('profile.view-profile',compact('user'));
        }
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
     * Cambia el status de un usuario
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
        } catch (\Throwable $th) {
            throw $th;
        } 
    }

    /**
     * Cambia el tipo de usuario
     * 
     * @param int $id
     * @param int $kind
     * @return $message
     */
    public static function kind($id,$kind){
        $data = User::find($id);
        try {
            $data->kind_Id = $kind;
            $data->save();
        } catch (\Throwable $th) {
            throw $th;
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
