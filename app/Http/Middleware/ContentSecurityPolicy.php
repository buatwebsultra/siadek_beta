<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentSecurityPolicy
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
        $response = $next($request);

        // Define CSP policy
        // Allowed: 
        // - self: same domain
        // - unsafe-inline: needed for many older Laravel templates/plugins (use with caution)
        // - unsafe-eval: used by some jquery plugins
        // - CDNs used in the project: code.jquery.com, cdn.jsdelivr.net, stackpath.bootstrapcdn.com, fonts.googleapis.com, fonts.gstatic.com, cdn.materialdesignicons.com
        $csp = "default-src 'self'; ";
        $csp .= "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://code.jquery.com https://cdn.jsdelivr.net https://stackpath.bootstrapcdn.com; ";
        $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net https://stackpath.bootstrapcdn.com https://cdn.materialdesignicons.com; ";
        $csp .= "font-src 'self' data: https://fonts.gstatic.com https://cdn.jsdelivr.net https://stackpath.bootstrapcdn.com https://cdn.materialdesignicons.com; ";
        $csp .= "img-src 'self' data: *; "; // Allow images from anywhere for flexibility
        $csp .= "frame-src 'self'; ";
        $csp .= "connect-src 'self'; ";

        // Inject headers
        $response->headers->set('Content-Security-Policy', $csp);
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        return $response;
    }
}
