<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserStoreRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of all users except dev users.
     */
    public function users(Request $request)
    {
        $tab = $request->query('tab', 'staff');

        if ($tab === 'clients') {
            $users = User::where('type', 'client')
                ->where(function ($query) {
                    $query->whereHas('role', function ($qr) {
                        $qr->where('name', '!=', 'dev');
                    })->orWhereNull('role_id');
                })
                ->latest()
                ->paginate(10);
        } else {
            $users = User::whereIn('type', ['admin', 'manager'])
                ->where(function ($query) {
                    $query->whereHas('role', function ($qr) {
                        $qr->where('name', '!=', 'dev');
                    })->orWhereNull('role_id');
                })
                ->latest()
                ->paginate(10);
        }

        $roles = Role::where('name', '!=', 'dev')->get();

        return view('admin.users.index', compact('users', 'tab', 'roles'));
    }

    /**
     * Show the form for creating a new user except dev roles.
     */
    public function createUser()
    {
        $roles = Role::where('name', '!=', 'dev')->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(UserStoreRequest $request)
    {
        $devRole = Role::where('name', 'dev')->first();
        $devRoleId = $devRole ? $devRole->id : null;
        $data = $request->validated();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'] ?? null,
            'phone' => $data['phone'] ?? null,
            'passport' => $data['passport'] ?? null,
            'jshshir' => $data['jshshir'] ?? null,
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'type' => $data['type'],
            'status' => 1,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Yangi foydalanuvchi muvaffaqiyatli yaratildi!');
    }

    /**
     * Show form to edit user.
     */
    public function editUser(User $user)
    {
        if ($user->type === 'dev' || ($user->role && $user->role->name === 'dev')) {
            abort(403, 'Taqiqlangan amal!');
        }

        $roles = Role::where('name', '!=', 'dev')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, User $user)
    {
        if ($user->type === 'dev' || ($user->role && $user->role->name === 'dev')) {
            abort(403, 'Taqiqlangan amal!');
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'nullable|string|max:255|alpha_dash|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'type' => 'required|string|in:admin,manager,client',
            'passport' => 'nullable|string|max:20',
            'jshshir' => 'nullable|string|max:20',
        ]);

        $devRole = Role::where('name', 'dev')->first();
        if ($data['role_id'] == ($devRole ? $devRole->id : -1) || $data['type'] === 'dev') {
            abort(403, 'Taqiqlangan amal!');
        }

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'] ?? null,
            'phone' => $data['phone'] ?? null,
            'passport' => $data['passport'] ?? null,
            'jshshir' => $data['jshshir'] ?? null,
            'role_id' => $data['role_id'],
            'type' => $data['type'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return redirect()->route('admin.users')
            ->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete the specified user.
     */
    public function deleteUser(User $user)
    {
        if ($user->type === 'dev' || ($user->role && $user->role->name === 'dev')) {
            abort(403, 'Taqiqlangan amal!');
        }

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users')
                ->with('error', 'O\'z hisobingizni o\'chira olmaysiz!');
        }

        $user->delete();

        return redirect()->route('admin.users')
            ->with('success', 'Foydalanuvchi muvaffaqiyatli o\'chirildi!');
    }
}
