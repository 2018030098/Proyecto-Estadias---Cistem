<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class status
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->status != 1){
            $message = ["status" => true,"title" => "Error" ,"message" => "Las credenciales no son validas", "class" => "bg-warning", "icon" => "fas fa-exclamation-triangle"];
            
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            session()->forget($request->user()->id);

            return response()->view('auth.login', compact('message'));
        }
        return $next($request);
    }
}
