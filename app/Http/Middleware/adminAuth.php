<?php 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class AdminAuth
{
    public function handle(Request $request, Closure $next, string $permission = null)
    {
        // 1. Must be logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('status', 'Please log in to access the admin panel.');
        }
 
        $user = Auth::user();
 
        // 2. Must be active
        if (!$user->is_active) {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => 'Your account has been deactivated. Contact the super admin.']);
        }
 
        // 3. Must be an admin
        if (!$user->isAdmin()) {
            abort(403, 'Access denied. Admins only.');
        }
 
        // 4. Check specific permission if provided
        if ($permission && !$user->can_do($permission)) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'You do not have permission to access that section.');
        }
 
        return $next($request);
    }
}
 