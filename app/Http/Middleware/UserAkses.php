<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAkses
{
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */
        public function handle(Request $request, Closure $next, ... $role)
        {
            // Periksa apakah pengguna terautentikasi
            if (auth()->check()) {
                // Periksa apakah pengguna memiliki peran yang diperlukan
                if (in_array(auth()->user()->role, $role)) {
                    return $next($request);
                }
            }
    
            // Pengguna tidak terautentikasi atau tidak memiliki peran yang diperlukan
            return response()->json('Anda Tidak Diperbolehkan Untuk Masuk Ke Halaman Ini');
        }
}
