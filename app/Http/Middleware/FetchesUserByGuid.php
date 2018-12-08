<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\User;

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