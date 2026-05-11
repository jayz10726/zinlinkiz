<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $team = TeamMember::orderBy('sort_order')->paginate(20);
        return view('admin.team.index', compact('team'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'bio'   => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $name     = $request->name;
        $parts    = explode(' ', trim($name));
        $initials = strtoupper(substr($parts[0],0,1).(isset($parts[1]) ? substr($parts[1],0,1) : ''));

        $data = [
            'name'         => $name,
            'role'         => $request->role,
            'bio'          => $request->bio,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'initials'     => $initials,
            'avatar_color' => $request->avatar_color ?? 'bg-blue-600',
            'sort_order'   => TeamMember::count(),
            'is_active'    => $request->has('is_active'),
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($data);
        return redirect()->route('admin.team')->with('success', $name.' added to the team.');
    }

    public function update(Request $request, $id)
    {
        $member = TeamMember::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|string|max:255',
            'bio'   => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $name     = $request->name;
        $parts    = explode(' ', trim($name));
        $initials = strtoupper(substr($parts[0],0,1).(isset($parts[1]) ? substr($parts[1],0,1) : ''));

        $data = [
            'name'         => $name,
            'role'         => $request->role,
            'bio'          => $request->bio,
            'phone'        => $request->phone,
            'email'        => $request->email,
            'initials'     => $initials,
            'avatar_color' => $request->avatar_color ?? $member->avatar_color,
            'is_active'    => $request->has('is_active'),
        ];

        if ($request->hasFile('photo')) {
            if ($member->photo) Storage::disk('public')->delete($member->photo);
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $member->update($data);
        return redirect()->route('admin.team')->with('success', $name.' updated successfully.');
    }

    public function destroy($id)
    {
        $member = TeamMember::findOrFail($id);
        if ($member->photo) Storage::disk('public')->delete($member->photo);
        $name = $member->name;
        $member->delete();
        return back()->with('success', $name.' removed from the team.');
    }
}