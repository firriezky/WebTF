<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table = "agenda";

    // id	type	title	description	start	end	created_at	updated_at	

    protected $fillable = [
        'type',
        'title',
        'description',
        'start',
        'end',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        // 'password', 'remember_token',
    ];

}
