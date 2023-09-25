<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Userdetail extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user_details';

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
