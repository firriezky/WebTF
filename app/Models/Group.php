<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Group extends Model
{
    use Notifiable;
    protected $table = 'kelompok';

    protected $fillable = [
        'name',
        'id_mentor',
        'category',
        'announcement',
        'updated_at',
        'created_at',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}