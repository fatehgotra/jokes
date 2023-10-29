<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupGuessLocation extends Model
{
    use HasFactory;

    protected $table = 'group_guess_location';

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

    public function ques(){

        return $this->hasMany(LocalTriviaQues::class);
    }
}
