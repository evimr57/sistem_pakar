<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('super-admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('super-admin.users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'alpha_dash', 'unique:users,username'],
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'no_hp' => ['nullable', 'string', 'max:15'],
            'role' => ['required', 'in:super_admin,admin,user'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = now();

        User::create($validated);

        return redirect()->route('super-admin.users.index')
                        ->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing user.
     */
    public function edit(User $user)
    {
        return view('super-admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'alpha_dash', Rule::unique('users')->ignore($user->id)],
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'no_hp' => ['nullable', 'string', 'max:15'],
            'role' => ['required', 'in:super_admin,admin,user'],
        ]);

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('super-admin.users.index')
                        ->with('success', 'User berhasil diupdate!');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        // Cegah super admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('super-admin.users.index')
                            ->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->route('super-admin.users.index')
                        ->with('success', 'User berhasil dihapus!');
    }
}