<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupGrogWheel extends Model
{
    use HasFactory;

    protected $table = "group_grog_wheel";

    protected $fillable = [
        'name',
        'description',
        'status'
    ];

    public function ques(){

        return $this->hasMany(GroupGrogWheelQues::class);
    }
}
