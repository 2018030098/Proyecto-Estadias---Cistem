<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_Id'];

    protected function allInfo(){
        $data = 0;

        return $data;
    }
}
