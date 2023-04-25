<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->is_admin){ //Если пользователь авторизован и является админом, он сможет пройти
            return $next($request);                 //В admin панель
        }
        abort('404');           //В обратном случае выдаем ошибку 404 (чтобы скрыть панель)
    }
}
