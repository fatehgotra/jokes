<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuessTheVoiceQues extends Model
{
    use HasFactory;

    protected $table = 'guess_the_voice_questions';

    protected $fillable = [

        'text',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'file',
        'correct_option',
        'status',

    ];

}
