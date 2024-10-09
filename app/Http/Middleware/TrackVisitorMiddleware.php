<?php

namespace App\Http\Middleware;

use App\Models\Post;
use App\Models\Visitors;
use Closure;
use Illuminate\Http\Request;

class TrackVisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $slug = $request->route('slug');
        $post = Post::where('slug', $slug)->first();
        $ip_address = $request->ip();

        $exis_ip_address = Visitors::where([
            ['post_id', $post->id],
            ['ip_address', $ip_address]
        ])->exists();

        if (!$exis_ip_address) {
            Visitors::create([
                'post_id' => $post->id,
                'ip_address' => $ip_address
            ]);
        }

        return $next($request);
    }
}
