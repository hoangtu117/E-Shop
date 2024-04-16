<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,...$guards): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        if(Auth::check()&& Auth::user()->role==1){
           redirect()->route('admin.index')->with('success','Đăng nhập thành công');
        }
        else{
            return redirect('/')->with('success','Đăng nhập thành công'); 
        }
        return $next($request);
        
    }
}
