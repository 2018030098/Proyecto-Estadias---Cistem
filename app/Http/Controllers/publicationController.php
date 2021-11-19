<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;

class publicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publication = Publication::getAllPublication();
        dd($publication);
        $user = User::all();
        $comments = Comment::all();
        $auth = auth()->user();
        $image = Image::all();
        return view('social.index', compact('publication','user','comments','auth','image'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = auth()->user();
        $publish = new Publication();
        $publish->user_Id = $users->id;
        $name = $users->name;
        return view('social.create-publication-form', compact(['publish','name']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->has('title')) {
                // Insercion de Publicacion
                $data = $request->all();
                if ($request->hasFile('image')) {
                    $i = 0;
                    // Obtencion de la direccion de cada imagen recibida / cada una de las direcciones se guardan en un arreglo
                    foreach ($request->image as $image) {
                        $img_path = $image->store('media-publication','public');
                        $path['featured_image_url'][$i] = $img_path;
                        $i++;
                    }
                }
                $users = ["user_Id" => auth()->user()->id]; 
                $data = array_merge($data,$users);
                // creacion de la publicacion / ademas guardando dicha informacion en una variable para obtener su ID
                $newPublic = (Publication::create($data));
                $newPublic = ["publish_Id" => $newPublic->id];
                foreach ($path['featured_image_url'] as $image) {
                    $dataImg = array_merge(["img_path" => $image],$newPublic);
                    Image::create($dataImg);
                }
                $message = ["status" => true,"title" => "Exito" ,"message" => "La publicacion se creo con exito", "classTitle" => "bg-success bg-gradient", "classBody" => "bg-success bg-opacity-50", "icon" => "fas fa-check-circle"];
            }
            elseif($request->has('comment')) {
                // Insercion de Comentario
                $data = $request->all();
                $users = ["user_Id" => auth()->user()->id]; 
                $data = array_merge($data,$users);
                Comment::create($data);
                $message = ["status" => false]; // si no se envia la variable message marcara error / el false hace que no se muestre nada
            }
        } catch (\Throwable $th) {
            throw $th; // expandir mensajes de error por codigo / cada falla tiene su codigo
            $message = ["status" => true,"title" => "Error" ,"message" => "No se pudo crear la publicacion correctamente", "classTitle" => "bg-danger bg-gradient", "classBody" => "bg-danger bg-opacity-50", "icon" => "fas fa-exclamation-triangle"];
        } finally {
            return redirect()->route('social.index')->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
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
