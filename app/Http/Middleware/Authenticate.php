<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {

            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            if ($request->is('user') || $request->is('user/*')) {
                return route('user.login');
            }

            if ($request->is('group') || $request->is('group/*')) {
                return route('group.group-login');
            }
            // if ($request->is('group-valid')) {
            //     return $request;
            // }
        }
       // $url = url()->current();

       // return $request->expectsJson() ? null : (str_contains($url, 'admin') ? route('admin.login') :  route('user.login'));
    }
}
