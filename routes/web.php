<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Welcome page
Route::get('/', function () {
    $regions = \App\Models\Region::with('cities')->get();
    return view('welcome', compact('regions'));
});

// Authentication routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Developer Dashboard
    Route::middleware('role:dev')->group(function () {
        Route::get('/developer/dashboard', [DashboardController::class, 'developer'])->name('developer.dashboard');
        Route::get('/developer/users', [\App\Http\Controllers\DeveloperController::class, 'users'])->name('developer.users');
        Route::get('/developer/users/create', [\App\Http\Controllers\DeveloperController::class, 'createUser'])->name('developer.users.create');
        Route::post('/developer/users', [\App\Http\Controllers\DeveloperController::class, 'storeUser'])->name('developer.users.store');
        Route::get('/developer/users/{user}/edit', [\App\Http\Controllers\DeveloperController::class, 'editUser'])->name('developer.users.edit');
        Route::put('/developer/users/{user}', [\App\Http\Controllers\DeveloperController::class, 'updateUser'])->name('developer.users.update');
        Route::delete('/developer/users/{user}', [\App\Http\Controllers\DeveloperController::class, 'deleteUser'])->name('developer.users.delete');
        
        // Roles management
        Route::get('/developer/roles', [\App\Http\Controllers\DeveloperController::class, 'roles'])->name('developer.roles');
        Route::post('/developer/roles', [\App\Http\Controllers\DeveloperController::class, 'storeRole'])->name('developer.roles.store');
        Route::put('/developer/roles/{role}', [\App\Http\Controllers\DeveloperController::class, 'updateRole'])->name('developer.roles.update');
        Route::delete('/developer/roles/{role}', [\App\Http\Controllers\DeveloperController::class, 'deleteRole'])->name('developer.roles.delete');

        // Categories & SubCategories management
        Route::get('/developer/categories', [\App\Http\Controllers\DeveloperCategoryController::class, 'index'])->name('developer.categories');
        Route::post('/developer/categories', [\App\Http\Controllers\DeveloperCategoryController::class, 'storeCategory'])->name('developer.categories.store');
        Route::put('/developer/categories/{category}', [\App\Http\Controllers\DeveloperCategoryController::class, 'updateCategory'])->name('developer.categories.update');
        Route::delete('/developer/categories/{category}', [\App\Http\Controllers\DeveloperCategoryController::class, 'deleteCategory'])->name('developer.categories.delete');

        Route::post('/developer/subcategories', [\App\Http\Controllers\DeveloperCategoryController::class, 'storeSubCategory'])->name('developer.subcategories.store');
        Route::put('/developer/subcategories/{subCategory}', [\App\Http\Controllers\DeveloperCategoryController::class, 'updateSubCategory'])->name('developer.subcategories.update');
        Route::delete('/developer/subcategories/{subCategory}', [\App\Http\Controllers\DeveloperCategoryController::class, 'deleteSubCategory'])->name('developer.subcategories.delete');

        // Infrastructure (Metros & Universities)
        Route::get('/developer/infrastructure', [\App\Http\Controllers\DeveloperInfrastructureController::class, 'index'])->name('developer.infrastructure');
        
        // Metros Actions
        Route::post('/developer/metros', [\App\Http\Controllers\DeveloperMetroController::class, 'store'])->name('developer.metros.store');
        Route::put('/developer/metros/{metro}', [\App\Http\Controllers\DeveloperMetroController::class, 'update'])->name('developer.metros.update');
        Route::delete('/developer/metros/{metro}', [\App\Http\Controllers\DeveloperMetroController::class, 'destroy'])->name('developer.metros.delete');

        // Universities Actions
        Route::post('/developer/universities', [\App\Http\Controllers\DeveloperUniversityController::class, 'store'])->name('developer.universities.store');
        Route::put('/developer/universities/{university}', [\App\Http\Controllers\DeveloperUniversityController::class, 'update'])->name('developer.universities.update');
        Route::delete('/developer/universities/{university}', [\App\Http\Controllers\DeveloperUniversityController::class, 'destroy'])->name('developer.universities.delete');
    });

    // Admin & Staff Dashboard
    Route::middleware('role:admin,manager')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/users/create', [\App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/admin/users', [\App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [\App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');

        // Categories & SubCategories management
        Route::get('/admin/categories', [\App\Http\Controllers\AdminCategoryController::class, 'index'])->name('admin.categories');
        Route::post('/admin/categories', [\App\Http\Controllers\AdminCategoryController::class, 'storeCategory'])->name('admin.categories.store');
        Route::get('/admin/categories/{category}/edit', [\App\Http\Controllers\AdminCategoryController::class, 'editCategory'])->name('admin.categories.edit');
        Route::put('/admin/categories/{category}', [\App\Http\Controllers\AdminCategoryController::class, 'updateCategory'])->name('admin.categories.update');
        Route::delete('/admin/categories/{category}', [\App\Http\Controllers\AdminCategoryController::class, 'deleteCategory'])->name('admin.categories.delete');

        Route::post('/admin/subcategories', [\App\Http\Controllers\AdminCategoryController::class, 'storeSubCategory'])->name('admin.subcategories.store');
        Route::get('/admin/subcategories/{subCategory}/edit', [\App\Http\Controllers\AdminCategoryController::class, 'editSubCategory'])->name('admin.subcategories.edit');
        Route::put('/admin/subcategories/{subCategory}', [\App\Http\Controllers\AdminCategoryController::class, 'updateSubCategory'])->name('admin.subcategories.update');
        Route::delete('/admin/subcategories/{subCategory}', [\App\Http\Controllers\AdminCategoryController::class, 'deleteSubCategory'])->name('admin.subcategories.delete');

        // Products management
        Route::get('/admin/products', [\App\Http\Controllers\AdminProductController::class, 'index'])->name('admin.products');
        Route::get('/admin/products/create', [\App\Http\Controllers\AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/admin/products', [\App\Http\Controllers\AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/admin/products/{product}/edit', [\App\Http\Controllers\AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/admin/products/{product}', [\App\Http\Controllers\AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{product}', [\App\Http\Controllers\AdminProductController::class, 'destroy'])->name('admin.products.delete');

        // Infrastructure
        Route::get('/admin/infrastructure', [\App\Http\Controllers\AdminInfrastructureController::class, 'index'])->name('admin.infrastructure');

        // Metros management
        Route::post('/admin/metros', [\App\Http\Controllers\AdminMetroController::class, 'store'])->name('admin.metros.store');
        Route::put('/admin/metros/{metro}', [\App\Http\Controllers\AdminMetroController::class, 'update'])->name('admin.metros.update');
        Route::delete('/admin/metros/{metro}', [\App\Http\Controllers\AdminMetroController::class, 'destroy'])->name('admin.metros.delete');

        // Universities management
        Route::post('/admin/universities', [\App\Http\Controllers\AdminUniversityController::class, 'store'])->name('admin.universities.store');
        Route::put('/admin/universities/{university}', [\App\Http\Controllers\AdminUniversityController::class, 'update'])->name('admin.universities.update');
        Route::delete('/admin/universities/{university}', [\App\Http\Controllers\AdminUniversityController::class, 'destroy'])->name('admin.universities.delete');
    });

    // Client Dashboard
    Route::middleware('role:client')->group(function () {
        Route::get('/client/dashboard', [DashboardController::class, 'client'])->name('client.dashboard');
    });
});
