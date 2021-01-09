<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;
    protected $table = 'student';
    protected $guard = 'student';

    protected $fillable = [
        'name',
        'contact',
        'email',
         'password',
         'nisn',
         'kelas',
         'id_kelompok',
         'password',
         'url_profile',
         'gender',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}