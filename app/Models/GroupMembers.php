<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class GroupMembers extends Authenticatable
{
   use HasApiTokens, HasFactory;

    protected $table = 'group_members';

    protected $fillable = [
        'group_id',
        'email',
        'display_name',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

}
