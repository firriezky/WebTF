<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahfidzTask extends Model
{
    use HasFactory;
    protected $table = 'setoran';

    protected $fillable = [
        'student_id',
        'status',
        'score_makhroj',
        'score_ahkam',
        'score_itqan',
        'score',
        'start',
        'end',
        'correction',
        'created_at',
        'updated_at',
    ];
}
