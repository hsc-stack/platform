<?php

namespace App\Http\Middleware;

use App\Models\Traffic;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackTraffic
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $source = $request->query('utm_source') ?? match (true) {
            $request->has('fbclid')  => 'facebook',
            $request->has('gclid')   => 'google_ads',
            $request->has('igshid')  => 'instagram',
            $request->has('ttclid')  => 'tiktok',
            default => 'direct',
        };

        $traffic = Traffic::firstOrCreate(
            ['ip_address' => $request->ip()],
            [
                'user_agent' => $request->userAgent(),
                'source' => $source,
            ]
        );

        $traffic->increment('visits');


        return $next($request);
    }
}
