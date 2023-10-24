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
        'ques_id',
        'answer_by',
    ];
}
