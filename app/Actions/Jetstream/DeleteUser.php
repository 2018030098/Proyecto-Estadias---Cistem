<?php

namespace App\Actions\Jetstream;

use App\Models\Publication;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        $user->status = 2;
        $user->email = $user->email." (delete)";

        $publications = Publication::all();
        $i = 0;
        foreach ($publications as $public) {
            if($public->user_Id == $user->id){
                $publication[$i] = $public;
            }
            $i++;
        }

        foreach ($publication as $public) {
            if($public->status != 0){
                $public->status = 2;
                $public->save();
            }
        }
        $user->save();
    }
}
