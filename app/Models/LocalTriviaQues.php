<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalTriviaQues extends Model
{
    use HasFactory;

    protected $table = 'question_local_trivia';

    protected $fillable = [

        'question',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'correct_option',
        'image',

    ];

    // public function game(){

    //     return $this->belongsTo(LocalTrivia::class,'game_id','id');
    // }
}
