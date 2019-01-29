<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\User;

/**
 * Middleware that fetches the user specified the guid on the request and inserts it into the request
 * prior to calling the Controller method. If the guid does not correspond to an actual user, then a
 * redirection to home is invoked
 */

class FetchesUserByGuid {

    public function handle($request, Closure $next) {
        $guid = $request->input('guid');
        $user = User::where('guid', $guid)->first();

        if (null === $user) {
            return redirect('home');
        }

        return $next($request->merge(['user' => $user]));
    }

}