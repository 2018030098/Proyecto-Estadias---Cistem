<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\User;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_Id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
