<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupScores extends Model
{
    use HasFactory;

    protected $table = 'group_scores';

    protected $fillable = [

        'group_id',
        'game',
        'score',
        'status',
        'image',
    ];

    public function group(){
        return $this->belongsTo(Groups::class,'group_id');
    }
}
