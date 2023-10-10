<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrueFalse extends Model
{
    use HasFactory;

    protected $table = 'game_true_false';

    protected $fillable = [

        'name',
        'description',
        'ques_time_limit',
        'game_question_limit',
        'lifeline',
        'rules',
        'qualified_score',
        'status',
    ];
}
