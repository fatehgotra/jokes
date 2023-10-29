<?php

use App\Models\GroupMembers;
use App\Models\User;

function candidate_name($email){

    $user   =  GroupMembers::where('email' ,$email)->get()->pluck('display_name');
        if( empty($user) ) {
            $user = User::where('email',$email)->first()->pluck('name');
        } 

    return $user;
}