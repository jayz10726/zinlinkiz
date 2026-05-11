<?php
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
 
class AdminController extends Controller
{
    // List all admin users
    public function index()
    {
        $this->requireSuperAdmin();
        $admins = User::whereIn('role', ['admin', 'super_admin'])
                      ->orWhere('is_admin', true)
                      ->latest()
                      ->paginate(20);
        return view('admin.admins.index', compact('admins'));
    }
 
    // Store a new admin
    public function store(Request $request)
    {
        $this->requireSuperAdmin();
 
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'nullable|string|max:20',
            'password' => ['required', Password::min(8)->mixedCase()->numbers()],
            'role'     => 'required|in:admin,super_admin',
        ]);
 
        $permissions = [
            'manage_products'  => $request->has('perm_products'),
            'manage_orders'    => $request->has('perm_orders'),
            'manage_reviews'   => $request->has('perm_reviews'),
            'manage_team'      => $request->has('perm_team'),
            'manage_inventory' => $request->has('perm_inventory'),
            'manage_carousel'  => $request->has('perm_carousel'),
            'manage_admins'    => $request->has('perm_admins'),
        ];
 
        // Super admins get all permissions
        if ($request->role === 'super_admin') {
            $permissions = array_map(fn() => true, $permissions);
        }
 
        User::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'phone'       => $request->phone,
            'password'    => Hash::make($request->password),
            'role'        => $request->role,
            'is_admin'    => true,
            'permissions' => $permissions,
            'is_active'   => true,
        ]);
 
        return redirect()->route('admin.admins')
                         ->with('success', $request->name . ' added as ' . ucfirst($request->role) . '.');
    }
 
    // Update admin permissions
    public function update(Request $request, $id)
    {
        $this->requireSuperAdmin();
 
        $admin = User::findOrFail($id);
 
        // Cannot edit yourself via this form
        if ($admin->id === auth()->id()) {
            return back()->with('error', 'You cannot edit your own account here. Use Profile Settings.');
        }
 
        $request->validate([
            'role' => 'required|in:admin,super_admin',
        ]);
 
        $permissions = [
            'manage_products'  => $request->has('perm_products'),
            'manage_orders'    => $request->has('perm_orders'),
            'manage_reviews'   => $request->has('perm_reviews'),
            'manage_team'      => $request->has('perm_team'),
            'manage_inventory' => $request->has('perm_inventory'),
            'manage_carousel'  => $request->has('perm_carousel'),
            'manage_admins'    => $request->has('perm_admins'),
        ];
 
        if ($request->role === 'super_admin') {
            $permissions = array_map(fn() => true, $permissions);
        }
 
        $admin->update([
            'role'        => $request->role,
            'is_admin'    => true,
            'permissions' => $permissions,
            'is_active'   => $request->has('is_active'),
        ]);
 
        return redirect()->route('admin.admins')
                         ->with('success', $admin->name . '\'s permissions updated.');
    }
 
    // Reset another admin's password
    public function resetPassword(Request $request, $id)
    {
        $this->requireSuperAdmin();
 
        $admin = User::findOrFail($id);
 
        $request->validate([
            'new_password' => ['required', Password::min(8)->mixedCase()->numbers()],
        ]);
 
        $admin->update(['password' => Hash::make($request->new_password)]);
 
        return back()->with('success', 'Password for ' . $admin->name . ' has been reset.');
    }
 
    // Toggle active status
    public function toggleActive($id)
    {
        $this->requireSuperAdmin();
 
        $admin = User::findOrFail($id);
 
        if ($admin->id === auth()->id()) {
            return back()->with('error', 'You cannot deactivate your own account.');
        }
 
        $admin->update(['is_active' => !$admin->is_active]);
        $status = $admin->fresh()->is_active ? 'activated' : 'deactivated';
 
        return back()->with('success', $admin->name . ' has been ' . $status . '.');
    }
 
    // Remove admin (downgrade to customer or delete)
    public function destroy($id)
    {
        $this->requireSuperAdmin();
 
        $admin = User::findOrFail($id);
 
        if ($admin->id === auth()->id()) {
            return back()->with('error', 'You cannot remove your own admin account.');
        }
 
        // If they have orders as customer, downgrade not delete
        if ($admin->orders()->count() > 0) {
            $admin->update([
                'role'        => 'customer',
                'is_admin'    => false,
                'permissions' => null,
            ]);
            return back()->with('success', $admin->name . ' has been downgraded to customer (had orders).');
        }
 
        $admin->delete();
        return back()->with('success', $admin->name . ' has been removed.');
    }
 
    // Admin changes their OWN password
    public function changeOwnPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        ]);
 
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
 
        auth()->user()->update(['password' => Hash::make($request->new_password)]);
 
        return back()->with('success', 'Your password has been updated successfully.');
    }
 
    private function requireSuperAdmin(): void
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403, 'Only Super Admins can manage other admins.');
        }
    }
}