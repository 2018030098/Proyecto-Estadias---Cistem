<?php

namespace App\View\Components;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class home extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $publication = DB::table('publications')->orderBy('updated_at','desc')->where('status','=','1')->get();
        $users = DB::table('users')->where('status','=','1')->get();
        for ($i=0, $inc = 0; $i < 4 && $inc < count($publication); $inc++) { 
            foreach ($users as $usr) {
                if ($publication[$inc]->user_Id == $usr->id) {
                    $user[$inc]['id'] = $usr->id;
                    $user[$inc]['name'] = $usr->name;
                    $user[$inc]['kind'] = $usr->kind_Id;

                    
                    break;
                }
            }
            if ($user[$inc]['kind'] == '1' || $user[$inc]['kind'] == '2') {
                $info[$i] = [
                    "id" => $publication[$inc]->id,
                    "title" => $publication[$inc]->title,
                    "name" => $user[$inc]['name'],
                    "description" => $publication[$inc]->description,
                    "date" => $publication[$inc]->updated_at
                ];
                $i++;
            }elseif ($user[$inc]['id'] == auth()->user()->id) {
                $info[$i] = [
                    "id" => $publication[$inc]->id,
                    "title" => $publication[$inc]->title,
                    "name" => $user[$inc]['name'],
                    "description" => $publication[$inc]->description,
                    "date" => $publication[$inc]->updated_at
                ];
                $i++;
            }
        }

        return view('components.home', compact('info'));
    }

    /**
     * obtener la informacion necesaria para la vista de home
     * 
     * @return array $data
     */
    public function getInfoHome(){
        return "Hola mundo";
    }
}
