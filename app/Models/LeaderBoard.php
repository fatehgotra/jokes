<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaderBoard extends Model
{
    use HasFactory;

    protected $table = 'leader_board';

    protected $fillable = [

        'game',
        'user_id',
        'score',
        'status',
    ];

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }
}
