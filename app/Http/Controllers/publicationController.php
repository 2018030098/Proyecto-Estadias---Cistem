<?php

namespace App\Http\Controllers;

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
        $publication = Publication::all();
        dd($publication);
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
            $data = $request->all();
            $users = ["user_Id" => auth()->user()->id]; 
            $data = array_merge($data,$users);
            Publication::create($data);
            $message = ["status" => true,"title" => "Exito" ,"message" => "La publicacion se creo con exito", "classTitle" => "bg-success bg-gradient", "classBody" => "bg-success bg-opacity-50", "icon" => "fas fa-check-circle"];
        } catch (\Throwable $th) {
            //throw $th; // expandir mensajes de error por codigo / cada falla tiene su codigo
            $message = ["status" => true,"title" => "Error" ,"message" => "No se pudo crear la publicacion correctamente", "classTitle" => "bg-danger bg-gradient", "classBody" => "bg-danger bg-opacity-50", "icon" => "fas fa-exclamation-triangle"];
        } finally {
            return redirect()->route('social.index')->with($message);
        }


        // $data = $request->all();

        // if ($request->has('image')) {
        //     $image_path = $request->file('image')->store('medias');
        //     $data['featured_image_url'] = $image_path;
        // }
        // Product::create($data);

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
