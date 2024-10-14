<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class RbacMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = auth()->user();

        $current = Route::getCurrentRoute()->uri;

        $excepts = [
            "inbound/bc-40/tambah-barang",
            "inbound/bc-40/pilih-barang"
        ];

        /* if (!in_array(getUrlAction(), $excepts)) { */
        /*     if (!$user->can(getUrlAction()) && $current != getUrlAction("data")) { */
        /*         //abort(401); */
        /*     } */
        /* } */



        return $next($request);
    }
}
