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
        // Obtencion de la informacion de la base de datos
        $Publications = Publication::all();
        $Users = User::all();
        $Images = Image::all();
        $Comments = Comment::all();
        $auth = auth()->user();

        $i = 0;
        foreach ($Publications as $public) { // filtrado de informacion / la informacion de las publicaciones se agrupan en arreglos
            if ($public->status === 1) { // Recorre cada una de las publicaciones, pasando solo por las que estan activas
                
                foreach ($Users as $usr) {  // Encontrar al usuario que le pertenece la publicacion
                    if ($usr->id === $public->user_Id) {
                        $user = $usr;
                        break;
                    }
                }

                $inc = 0;
                $image = null;
                foreach ($Images as $img) { // Encontrar todas las imagenes que le pertenecen a la publicacion
                    if ($img->publish_Id === $public->id) {
                        $image[$inc] = $img->img_path; 
                        $inc++;
                    }
                }

                $inc = 0;
                $comment = null;
                foreach ($Comments as $comm) { // Encontrar todos los commentarios que le pertenecen a la publicacion
                    if ($comm->publish_Id === $public->id) {
                        if ($comm->user_Id === $user->id) { // Encontrar al usuario que le pertenece el comentario
                            $comment[$inc] = [
                                "name" => $user->name,
                                "profile_photo_path" => $user->profile_photo_path,
                                "comment" => $comm->comment,
                                "updated_at" => $comm->updated_at
                            ];
                        } else {
                            foreach ($Users as $usr) {
                                if ($comm->user_Id === $usr->id) {
                                    $comment[$inc] = [
                                        "name" => $usr->name,
                                        "profile_photo_path" => $usr->profile_photo_path,
                                        "comment" => $comm->comment,
                                        "updated_at" => $comm->updated_at
                                    ];
                                }
                            }
                        }
                        $inc++;
                    }
                }

                // creacion del objeto que contendra toda la informacion de la publicacion
                $publication[$i] = array_merge(
                    [
                        "user" => [
                            "name" => $user->name,
                            "profile_photo_path" => $user->profile_photo_path
                        ]
                    ],
                    [
                        "publication" => [
                            "id" => $public->id,
                            "title" => $public->title,
                            "description" => $public->description,
                            "updated_at" => $public->updated_at
                        ]
                    ],
                    [
                        "images" => $image
                    ],
                    [
                        "comments" => $comment
                    ],
                    [
                        "auth" => [
                            "profile_photo_path" => $auth->profile_photo_path
                        ]
                    ]
                );
                $i++;
            }
        }
        // dd($publication);
        return view('social.index', compact('publication'));
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
        return view('social.create-publication-form', compact(['publish','name','users']));
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
