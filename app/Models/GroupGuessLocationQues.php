<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupGuessLocationQues extends Model
{
    use HasFactory;

    protected $table = 'group_guess_location_ques';

    protected $fillable = [

        'question',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'correct_option',
        'image',
        'status',

    ];
}
