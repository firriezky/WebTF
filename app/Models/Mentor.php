<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mentor extends Authenticatable
{
    use Notifiable;
    protected $table = 'mentor';
    protected $guard = 'mentor';

    protected $fillable = [
        'name',
        'contact',
        'email',
        'password',
        'gender',
        'url_profile',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}