<?php

namespace App\Http\Middleware;

use App\Models\Tenants\General\Setting;
use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale =Setting::where('name', 'locale')->first()->value;
        app()->setLocale($locale);
        return $next($request);
    }
}
