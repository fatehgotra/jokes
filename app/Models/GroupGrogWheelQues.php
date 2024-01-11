<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupGrogWheelQues extends Model
{
    use HasFactory;

    protected $table = "group_grog_wheel_question";

    protected $fillable = [
        'name',
        'task'
    ];
}
