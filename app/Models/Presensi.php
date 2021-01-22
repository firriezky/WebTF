<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = "absensi";

    // id	student_id	agenda_id	status	created_at	updated_at
    //status 0 = Alfa
    //status 1 = Hadir
    //status 2 = Terlambat
    //status 3 = Sakit
    //status 4 = Izin Pulang
    //status 5 = Lomba
    protected $fillable = [
        'student_id',
        'agenda_id',
        'mentor_id',
        'status',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        // 'password', 'remember_token',
    ];

}
