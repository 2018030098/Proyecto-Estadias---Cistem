<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publish extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_Id'];
}