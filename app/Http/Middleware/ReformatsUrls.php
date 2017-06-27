<?php

namespace App\Http\Middleware;

use App\FormattedUrl;
use Closure;

class ReformatsUrls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $url_fields = array_merge(config('social.allowed_platforms'), ['website']);

        collect($url_fields)->reject(function($field) {
            return $field === 'email';
        })->each(function($field) use ($request) {
            if($request->has($field)) {
                $formatted =[$field => FormattedUrl::from($request->{$field}, $field !== 'website')];
                $request->merge($formatted);
            }
        });
        return $next($request);
    }
}
