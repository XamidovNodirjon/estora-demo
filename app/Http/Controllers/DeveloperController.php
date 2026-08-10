<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeveloperController extends Controller
{
    /**
     * Display a listing of all products/announcements for developers.
     */
    public function products()
    {
        $products = \App\Models\Product::with(['user', 'category', 'subCategory', 'region', 'city'])
            ->latest()
            ->paginate(15);

        return view('developer.products.index', compact('products'));
    }

    /**
     * Display a listing of all users.
     */
    public function users()
    {
        $users = User::with('role')->latest()->paginate(10);
        $roles = Role::all();
        return view('developer.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function createUser()
    {
        $roles = Role::all();
        return view('developer.users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users|alpha_dash',
            'phone' => 'nullable|string|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'type' => 'required|string|in:dev,admin,manager,client',
            'passport' => 'nullable|string|max:20',
            'jshshir' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'phone' => $data['phone'] ?? null,
            'passport' => $data['passport'] ?? null,
            'jshshir' => $data['jshshir'] ?? null,
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
            'type' => $data['type'],
            'status' => 1,
        ]);

        return redirect()->route('developer.users')
            ->with('success', 'Yangi foydalanuvchi muvaffaqiyatli yaratildi!');
    }

    /**
     * Display a listing of all roles and show create form.
     */
    public function roles()
    {
        $roles = Role::withCount('users')->get();
        return view('developer.roles.roles', compact('roles'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function storeRole(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name|alpha_dash',
        ]);

        Role::create([
            'name' => $data['name'],
        ]);

        return redirect()->route('developer.roles')
            ->with('success', 'Yangi rol muvaffaqiyatli yaratildi!');
    }

    /**
     * Show form to edit role.
     */
    public function editRole(Role $role)
    {
        return view('developer.roles.edit', compact('role'));
    }

    /**
     * Update the specified role.
     */
    public function updateRole(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|alpha_dash|unique:roles,name,' . $role->id,
        ]);

        $role->update([
            'name' => $data['name'],
        ]);

        return redirect()->route('developer.roles')
            ->with('success', 'Rol muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete the specified role.
     */
    public function deleteRole(Role $role)
    {
        if ($role->name === 'dev') {
            return redirect()->route('developer.roles')
                ->with('error', 'Tizim dasturchisi (dev) rolini o\'chirib bo\'lmaydi!');
        }

        if ($role->users()->count() > 0) {
            return redirect()->route('developer.roles')
                ->with('error', 'Bu rolda foydalanuvchilar mavjud, shuning uchun uni o\'chirib bo\'lmaydi!');
        }

        $role->delete();

        return redirect()->route('developer.roles')
            ->with('success', 'Rol muvaffaqiyatli o\'chirildi!');
    }

    /**
     * Show form to edit user.
     */
    public function editUser(User $user)
    {
        $roles = Role::all();
        return view('developer.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|alpha_dash|unique:users,username,' . $user->id,
            'phone' => 'nullable|string|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role_id' => 'required|exists:roles,id',
            'type' => 'required|string|in:dev,admin,manager,client',
            'passport' => 'nullable|string|max:20',
            'jshshir' => 'nullable|string|max:20',
        ]);

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
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

        return redirect()->route('developer.users')
            ->with('success', 'Foydalanuvchi muvaffaqiyatli yangilandi!');
    }

    /**
     * Delete the specified user.
     */
    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('developer.users')
                ->with('error', 'O\'z hisobingizni o\'chira olmaysiz!');
        }

        $user->delete();

        return redirect()->route('developer.users')
            ->with('success', 'Foydalanuvchi muvaffaqiyatli o\'chirildi!');
    }
}
