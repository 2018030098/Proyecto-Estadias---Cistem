<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

class publicationController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = auth()->user();
        if (isset($_GET['order']) && $_GET['order'] == 1) { // Obtencion de la informacion de la base de datos
            $Publications = DB::table('publications')->orderBy('updated_at','asc')->where('status','=','1')->get();
            $order = 1;
        }else{
            $Publications = DB::table('publications')->orderBy('updated_at','desc')->where('status','=','1')->get();
            $order = 0;
        }
        if( count($Publications) == 0){
            $publication = 0;
            return view('social.index', compact('publication','order'));
        }

        $i = 0;
        foreach ($Publications as $public) { // filtrado de informacion / la informacion de las publicaciones se agrupan en arreglos
            $user = User::find($public->user_Id);

            $inc = 0;
            $image = null;
            $Images = DB::table('images')->where('publication_Id','=',$public->id)->where('status','=','1')->get();
            foreach ($Images as $img) { // Encontrar todas las imagenes que le pertenecen a la publicacion
                    $image[$inc] = $img->img_path; 
                    $inc++;
            }
            $num_img = $inc;
            $inc = 0;
            $comment = null;
            $Comments = DB::table('comments')->where('publication_Id','=',$public->id)->get();
            foreach ($Comments as $comm) { // Encontrar todos los commentarios que le pertenecen a la publicacion
                if ($comm->user_Id === $user->id) { // Encontrar al usuario que le pertenece el comentario
                    $comment[$inc] = [
                        "name" => $user->name,
                        "profile_photo_path" => $user->profile_photo_path,
                        "comment" => $comm->comment,
                        "updated_at" => $comm->updated_at
                    ];
                } else {
                    $usr = User::find($comm->user_Id);
                    $comment[$inc] = [
                        "name" => $usr->name,
                        "profile_photo_path" => $usr->profile_photo_path,
                        "comment" => $comm->comment,
                        "updated_at" => $comm->updated_at
                    ];
                }
                $inc++;
            }

            if($auth->kind_Id == 1 || $auth->kind_Id == 2){
                $publication[$i] = array_merge( // creacion del objeto que contendra toda la informacion de la publicacion
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
                        "numero_de_imagenes" => $num_img
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
            }elseif ($auth->kind_Id == 3) {
                if ($user->kind_Id == 1 || $user->kind_Id == 2 || $user->id == $auth->id) {
                    $publication[$i] = array_merge( // creacion del objeto que contendra toda la informacion de la publicacion
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
                            "numero_de_imagenes" => $num_img
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

        }

        // dd($publication); // observar que informacion tiene el arreglo generado
        return view('social.index', compact('publication','order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publication = ["user" => [
            "name" => auth()->user()->name,
            "profile_photo_path" => auth()->user()->profile_photo_path
            ]
        ];

        $cnd = false;
        // dd($publication); // observar que informacion tiene el arreglo generado
        return view('social.create-publication-form', compact('publication','cnd'));
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
                    foreach ($request->image as $image) { // Obtencion de la direccion de cada imagen recibida / cada una de las direcciones se guardan en un arreglo
                        if ($image->getMimeType() != "image/svg+xml" && $image->getMimeType() != "image/jpeg" && $image->getMimeType() != "image/png" && $image->getMimeType() != "image/webp" && $image->getMimeType() != "image/gif" ) {
                            $message = ["status" => true,"title" => "Problema" ,"message" => "El formato de archivo subido no esta permitido, por favor solo ingrese imagenes en el formato aceptado", "class" => "bg-warning", "icon" => "fas fa-exclamation-triangle"];
                            return redirect()->route('social.index')->with($message);
                        }
                        $img_path = $image->store('media-publication','public');
                        $path['featured_image_url'][$i] = $img_path;
                        $i++;
                    }
                }
                $users = ["user_Id" => auth()->user()->id]; 
                $data = [
                    'title' => $data['title'],
                    'description' => $data['description']
                ];
                $data = array_merge($data,$users);
                $newPublic = (Publication::create($data)); // creacion de la publicacion / ademas guardando dicha informacion en una variable para obtener su ID
                if ($request->hasFile('image')) {
                    foreach ($path['featured_image_url'] as $image) {
                        $dataImg = array_merge(["img_path" => $image],["publication_Id" => $newPublic->id]);
                        Image::create($dataImg);
                    }
                }
                $message = ["status" => true,"title" => "Exito" ,"message" => "La publicacion se creo con exito", "class" => "bg-success", "icon" => "fas fa-check-circle"];
            }
            elseif($request->has('comment')) { // Insercion de Comentario
                $data = $request->all();
                $users = ["user_Id" => auth()->user()->id]; 
                $data = array_merge($data,$users);
                Comment::create($data);
                $message = ["status" => false]; // si no se envia la variable message marcara error / el false hace que no se muestre nada
            }
        } catch (\Throwable $th) {
            // throw $th; // expandir mensajes de error por codigo / cada falla tiene su codigo
            $message = ["status" => true,"title" => "Error" ,"message" => "No se pudo crear la publicacion correctamente", "class" => "bg-danger", "icon" => "fas fa-exclamation-triangle"];
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
    public function show($id)
    {
        $public = Publication::find($id);
        $user = DB::table('users')->where('id','=',$public->user_Id)->get();
        $user = $user['0'];
        $comments = DB::table('comments')->where('publication_Id','=',$id)->get();
        $images = DB::table('images')->where('status','=','1')->where('publication_Id','=',$id)->get();
        $auth = auth()->user();

        $i = 0;
        if(count($comments) != 0){
            foreach ($comments as $comm ) {
                $comU = DB::table('users')->where('id','=',$comm->user_Id)->get();
                $comu = $comU['0'];
                $Comment[$i] = [
                    'user' => [
                        'name' => $comu->name,
                        'profile_photo_path' => $comu->profile_photo_path
                    ],
                    'comment' => [
                        'comment' => $comm->comment,
                        'updated_at' => $comm->updated_at
                    ]
                ];
                $i++;
            }
        } else {
            $Comment = null;
        }

        $i = 0;
        if(count($images) != 0){
            foreach ($images as $img ) {
                $image[$i] = [
                    'img_path' => $img->img_path
                ];
                $i++;
            }
        }else {
            $image = null;
        }
        $num_img = $i;

        if($auth->id == $user->id){
            $own = true;
        }else{
            $own = false;
        }

        $publication = [
            'user' => [
                'name' => $user->name,
                'profile_photo_path' => $user->profile_photo_path,
                'email' => $user->email
            ],
            'publication' => [
                'id' => $public->id,
                'title' => $public->title,
                'description' => $public->description,
                'updated_at' => $public->updated_at
            ],
            'images' => $image,
            'comments' => $Comment,
            'numero_de_imagenes' => $num_img,
            'auth' => [
                'name' => $auth->name,
                'profile_photo_path' => $user->profile_photo_path,
                'user' => $own
            ]
        ];

        // dd($publication);
        return view('social.show-publication', compact('publication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $public = Publication::find($id);
        $user = User::find($public->user_Id);
        $Images = Image::all();

        $i = 0;
        $image = null;
        foreach ($Images as $img ) {
            if ($img->publication_Id === $public->id && $img->status === 1) {
                $image[$i] = $img->img_path;
                $i++;
            }
        }
        $publication = [
            "user" => [
                "name" => $user->name,
                "profile_photo_path" => $user->profile_photo_path
            ],
            "publication" => [
                "id" => $public->id,
                "title" => $public->title,
                "description" => $public->description,
                "updated_at" => $public->updated_at,
                "created_at" => $public->created_at,
                "status" => $public->status
            ],
            "image" => $image
        ];

        $cnd = true;
        // dd($publication); // observar que informacion tiene el arreglo generado
        return view('social.create-publication-form', compact('publication','cnd'));
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
        try {
            $data = $request->all();
            $public = Publication::find($id);
            if ($public->status) {
                # code...
            }
            if ($public->title != $data['title'] || $public->description != $data['description'] || $request->hasFile('image')) {
                $public->title = $data['title'];
                $public->description = $data['description'];
                if ($request->hasFile('image')) {
                    $Images = Image::all();
                    foreach ($Images as $img ) {
                        if ($img->publication_Id === $public->id && $img->status === 1) {
                            $img->status = 0;
                            $img->save();
                        }
                    }
                    $i = 0;
                    foreach ($data['image'] as $image) { // Obtencion de la direccion de cada imagen recibida / cada una de las direcciones se guardan en un arreglo
                        $img_path = $image->store('media-publication','public');
                        $path['featured_image_url'][$i] = $img_path;
                        $i++;
                    }
                }
                if (isset($path['featured_image_url'])) {
                    foreach ($path['featured_image_url'] as $url) {
                        $dataImg = array_merge(["img_path" => $url],["publication_Id" => $public->id]);
                        Image::create($dataImg);
                    }
                }
                $public->save();
                $message = ["status" => true,"title" => "Exito" ,"message" => "La publicacion se modifico con exito", "class" => "bg-success", "icon" => "fas fa-check-circle"];
            }else {
                $message = ["status" => true,"title" => "Sin cambios" ,"message" => "no hubo ningun cambio en la publicacion", "class" => "bg-light", "icon" => "fas fa-check-circle"];
            }
        } catch (\Throwable $th) {
            // throw $th;
            $message = ["status" => true,"title" => "Error" ,"message" => "No se pudo actualizar la publicacion correctamente", "class" => "bg-warning", "icon" => "fas fa-exclamation-triangle"];
        } finally {
            return redirect()->route('social.index')->with($message);
        }
    }

    /**
     * Cambia el estado de una publicacion
     * 
     * @param int $id
     * @param int $status
     * @return $message
     */
    public static function status($id,$status){
        $data = Publication::find($id);
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
     * @param int       $id
     * @param string    $password
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try {
            $password = $_POST['passwordDelete'];
            $publication = Publication::find($id);
            $user = User::find($publication->user_Id);
            if( Hash::check( $password,$user->password ) ){
                publicationController::status($id,2);
                $message = ["status" => true,"title" => "Exito" ,"message" => "La publicacion se elimino con exito", "class" => "bg-success", "icon" => "fas fa-check-circle"];
            }else{
                $message = ["status" => true,"title" => "Incorrecto" ,"message" => 'La contraseña ingresada es incorrecta', "class" => "bg-warning", "icon" => "fas fa-exclamation-triangle"];
            }
        } catch (\Throwable $th) {
            //throw $th;
            $message = ["status" => true,"title" => "Error" ,"message" => 'No se pudo eliminar la publicacion', "class" => "bg-dnager", "icon" => "fas fa-exclamation-circle"];
        } finally{
            return redirect()->route('social.index')->with($message);   
        }
    }
}
