<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class AuthGuard {
    public function handle(Request $request, Closure $next):
        Response {
            if ($request->session()->has('admin_login_data')) return $next($request);
            else return redirect(url(ADMINPATH . 'login'));
        }
    }
    