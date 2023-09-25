<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';

    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'hobbies',
        'qualification',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
