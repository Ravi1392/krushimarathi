public function handle($request, Closure $next)
{
    if (!Auth::guard('customer')->check()) {
        return redirect('/ads/login');
    }

    return $next($request);
}