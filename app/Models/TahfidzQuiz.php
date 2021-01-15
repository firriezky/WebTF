<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahfidzQuiz extends Model
{
    use HasFactory;
    protected $table = 'quiz';

    protected $fillable = [
        'title',
        'description',
        'group_id',
        'gform_link',
        'created_at',
        'updated_at',
    ];
}
