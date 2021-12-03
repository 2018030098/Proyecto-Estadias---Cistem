<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['comment', 'publication_Id', 'user_Id'];

    public function publication(){
        return $this->belongsTo(Publication::class);
    }
}
