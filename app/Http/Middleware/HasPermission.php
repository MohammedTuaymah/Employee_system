<?php

namespace App\Http\Middleware;
use App\Traits\permissionTrait;
use Closure;
use Illuminate\Http\Request;

class HasPermission
{
    use permissionTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->hasPermission();

        return $next($request);
    }
}
