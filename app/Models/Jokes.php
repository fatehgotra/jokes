<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jokes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'joke',
        'status'
    ];

    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){

        return $this->hasOne(JokesCategory::class,'id','category_id');
    }
}
