<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupQues extends Model
{
    use HasFactory;

    protected $table = 'group_questions';

    protected $fillable = [
        
        'group_id',
        'game',
        'current_que',
        'ques_id',
        'selected_option',
        'correct',
        'answer_by',
    ];
}
