<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirect to the correct dashboard based on role.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user || !$user->role) {
            abort(403, 'Rol aniqlanmadi.');
        }

        switch ($user->role->name) {
            case 'dev':
                return redirect()->route('developer.dashboard');
            case 'admin':
            case 'manager':
                return redirect()->route('admin.dashboard');
            case 'client':
            default:
                return redirect()->route('client.dashboard');
        }
    }

    /**
     * Developer Dashboard view.
     */
    public function developer()
    {
        return view('developer.dashboard');
    }

    /**
     * Admin/Staff Dashboard view.
     */
    public function admin()
    {
        $clientsCount = User::whereHas('role', function($query) {
            $query->where('name', 'client');
        })->count();

        $productsCount = Product::count();
        $pendingCount = 0;
        $incomeAmount = 0;

        return view('admin.dashboard', compact('clientsCount', 'productsCount', 'pendingCount', 'incomeAmount'));
    }

    /**
     * Client Dashboard view.
     */
    public function client()
    {
        return view('client.dashboard');
    }
}
