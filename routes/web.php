<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Welcome page
Route::get('/', function () {
    $regions = \App\Models\Region::with('cities')->get();
    $metros = \App\Models\Metro::orderBy('name')->get();
    $universities = \App\Models\University::orderBy('name')->get();
    $categories = \App\Models\Category::whereNotIn('name', ['admin'])->get();
    $propertyTypes = \App\Models\SubCategory::whereNotIn('name', ['nimadir', 'sadjasd', 'test 1 sub', '322'])
        ->select('name')
        ->distinct()
        ->pluck('name');

    $mapProducts = \App\Models\Product::with(['category', 'subCategory', 'region', 'city'])
        ->where('status', 'active')
        ->get()
        ->map(function ($product) {
            $lat = $product->latitude ?: (41.2995 + (crc32($product->id . 'lat') % 1000) / 10000);
            $lng = $product->longitude ?: (69.2401 + (crc32($product->id . 'lng') % 1000) / 10000);
            $images = is_array($product->images) ? $product->images : json_decode($product->images ?? '[]', true);
            $firstImg = !empty($images) ? $images[0] : '/images/hero.png';
            if (!str_starts_with($firstImg, 'http') && !str_starts_with($firstImg, '/')) {
                $firstImg = '/storage/' . $firstImg;
            }
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => number_format($product->price) . ' USD',
                'lat' => (float)$lat,
                'lng' => (float)$lng,
                'category' => $product->category->name ?? 'Sotuv',
                'sub_category' => $product->subCategory->name ?? 'Kvartira',
                'region' => $product->region->name ?? 'Toshkent shahar',
                'city' => $product->city->name ?? 'Yashnobod tumani',
                'image' => $firstImg,
                'url' => route('products.show', $product->id),
            ];
        });

    $topProducts = \App\Models\Product::with(['category', 'subCategory', 'region', 'city', 'metros', 'universities', 'items'])
        ->where('status', 'active')
        ->where('is_top', true)
        ->latest()
        ->take(8)
        ->get();

    // Calculate regional & district real estate market analytics
    $allActiveProducts = \App\Models\Product::with(['region', 'city'])->where('status', 'active')->get();
    
    $regionAnalytics = \App\Models\Region::with('cities')->get()->map(function ($region) use ($allActiveProducts) {
        $regionProducts = $allActiveProducts->where('region_id', $region->id);
        $count = $regionProducts->count();
        $avgPrice = $count > 0 ? round($regionProducts->avg('price')) : rand(35000, 75000);
        
        $citiesData = $region->cities->map(function ($city) use ($regionProducts) {
            $cityProducts = $regionProducts->where('city_id', $city->id);
            $cityCount = $cityProducts->count();
            $cityAvg = $cityCount > 0 ? round($cityProducts->avg('price')) : rand(25000, 65000);
            return [
                'id' => $city->id,
                'name' => $city->name_uz ?? $city->name,
                'avg_price' => $cityAvg,
                'count' => $cityCount,
            ];
        })->sortByDesc('avg_price')->values();

        return [
            'id' => $region->id,
            'name' => $region->name,
            'count' => $count,
            'avg_price' => $avgPrice,
            'cities' => $citiesData,
        ];
    });

    $totalActiveProductsCount = $allActiveProducts->count();

    return view('welcome', compact('regions', 'metros', 'universities', 'categories', 'propertyTypes', 'mapProducts', 'topProducts', 'regionAnalytics', 'totalActiveProductsCount'));
});

Route::get('/maniDashboard', [\App\Http\Controllers\SearchController::class, 'maniDashboard'])->name('maniDashboard');
Route::get('/products/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
Route::post('/inquiries', [\App\Http\Controllers\InquiryController::class, 'store'])->name('inquiries.store');

// Smart Add Advertisement redirect
Route::get('/add-ad', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('client.products.create');
    }
    session()->put('url.intended', route('client.products.create'));
    return redirect()->route('register')
        ->with('info', 'E\'lon joylashtirish uchun avval ro\'yxatdan o\'ting yoki mavjud hisobingizga kiring!');
})->name('add.ad');

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
    Route::post('/favorites/toggle/{product}', [\App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::post('/messages', [\App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/reply', [\App\Http\Controllers\MessageController::class, 'reply'])->name('messages.reply');
    Route::post('/messages/read', [\App\Http\Controllers\MessageController::class, 'markAsRead'])->name('messages.read');

    Route::get('/client/favorites', function() {
        return redirect()->route('client.dashboard', ['section' => 'favorites']);
    })->name('client.favorites');

    // Developer Dashboard
    Route::middleware('role:dev')->group(function () {
        Route::get('/developer/dashboard', [DashboardController::class, 'developer'])->name('developer.dashboard');
        Route::get('/developer/users', [\App\Http\Controllers\DeveloperController::class, 'users'])->name('developer.users');
        Route::get('/developer/users/create', [\App\Http\Controllers\DeveloperController::class, 'createUser'])->name('developer.users.create');
        Route::post('/developer/users', [\App\Http\Controllers\DeveloperController::class, 'storeUser'])->name('developer.users.store');
        Route::get('/developer/users/{user}/edit', [\App\Http\Controllers\DeveloperController::class, 'editUser'])->name('developer.users.edit');
        Route::put('/developer/users/{user}', [\App\Http\Controllers\DeveloperController::class, 'updateUser'])->name('developer.users.update');
        Route::delete('/developer/users/{user}', [\App\Http\Controllers\DeveloperController::class, 'deleteUser'])->name('developer.users.delete');
        
        // Developer Products
        Route::get('/developer/products', [\App\Http\Controllers\DeveloperController::class, 'products'])->name('developer.products');
        Route::post('/developer/products/{product}/toggle-top', [\App\Http\Controllers\ClientProductController::class, 'toggleTop'])->name('developer.products.toggle-top');

        // Roles management
        Route::get('/developer/roles', [\App\Http\Controllers\DeveloperController::class, 'roles'])->name('developer.roles');
        Route::post('/developer/roles', [\App\Http\Controllers\DeveloperController::class, 'storeRole'])->name('developer.roles.store');
        Route::get('/developer/roles/{role}/edit', [\App\Http\Controllers\DeveloperController::class, 'editRole'])->name('developer.roles.edit');
        Route::put('/developer/roles/{role}', [\App\Http\Controllers\DeveloperController::class, 'updateRole'])->name('developer.roles.update');
        Route::delete('/developer/roles/{role}', [\App\Http\Controllers\DeveloperController::class, 'deleteRole'])->name('developer.roles.delete');

        // Categories & SubCategories management
        Route::get('/developer/categories', [\App\Http\Controllers\DeveloperCategoryController::class, 'index'])->name('developer.categories');
        Route::post('/developer/categories', [\App\Http\Controllers\DeveloperCategoryController::class, 'storeCategory'])->name('developer.categories.store');
        Route::get('/developer/categories/{category}/edit', [\App\Http\Controllers\DeveloperCategoryController::class, 'editCategory'])->name('developer.categories.edit');
        Route::put('/developer/categories/{category}', [\App\Http\Controllers\DeveloperCategoryController::class, 'updateCategory'])->name('developer.categories.update');
        Route::delete('/developer/categories/{category}', [\App\Http\Controllers\DeveloperCategoryController::class, 'deleteCategory'])->name('developer.categories.delete');

        Route::post('/developer/subcategories', [\App\Http\Controllers\DeveloperCategoryController::class, 'storeSubCategory'])->name('developer.subcategories.store');
        Route::get('/developer/subcategories/{subCategory}/edit', [\App\Http\Controllers\DeveloperCategoryController::class, 'editSubCategory'])->name('developer.subcategories.edit');
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

        // Product Items Actions (Amenities like Lift, Playground, etc.)
        Route::post('/developer/product-items', [\App\Http\Controllers\DeveloperProductItemController::class, 'store'])->name('developer.product-items.store');
        Route::put('/developer/product-items/{productItem}', [\App\Http\Controllers\DeveloperProductItemController::class, 'update'])->name('developer.product-items.update');
        Route::delete('/developer/product-items/{productItem}', [\App\Http\Controllers\DeveloperProductItemController::class, 'destroy'])->name('developer.product-items.delete');
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
        Route::post('/admin/products/{product}/toggle-top', [\App\Http\Controllers\ClientProductController::class, 'toggleTop'])->name('admin.products.toggle-top');
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

        // Product Items management (Amenities like Lift, Playground, etc.)
        Route::post('/admin/product-items', [\App\Http\Controllers\AdminProductItemController::class, 'store'])->name('admin.product-items.store');
        Route::put('/admin/product-items/{productItem}', [\App\Http\Controllers\AdminProductItemController::class, 'update'])->name('admin.product-items.update');
        Route::delete('/admin/product-items/{productItem}', [\App\Http\Controllers\AdminProductItemController::class, 'destroy'])->name('admin.product-items.delete');

        // Inquiries management
        Route::get('/admin/inquiries', [\App\Http\Controllers\AdminInquiryController::class, 'index'])->name('admin.inquiries.index');
        Route::get('/admin/inquiries/{inquiry}', [\App\Http\Controllers\AdminInquiryController::class, 'show'])->name('admin.inquiries.show');
        Route::put('/admin/inquiries/{inquiry}', [\App\Http\Controllers\AdminInquiryController::class, 'update'])->name('admin.inquiries.update');
    });

    // Client & Makler Dashboard
    Route::middleware('role:client,makler')->group(function () {
        Route::get('/client/dashboard', [DashboardController::class, 'client'])->name('client.dashboard');
        Route::put('/client/profile', [\App\Http\Controllers\ClientProfileController::class, 'update'])->name('client.profile.update');
        
        // Client & Makler Announcements Management
        Route::get('/client/products', [\App\Http\Controllers\ClientProductController::class, 'index'])->name('client.products.index');
        Route::get('/client/products/create', [\App\Http\Controllers\ClientProductController::class, 'create'])->name('client.products.create');
        Route::post('/client/products', [\App\Http\Controllers\ClientProductController::class, 'store'])->name('client.products.store');
        Route::get('/client/products/{product}/edit', [\App\Http\Controllers\ClientProductController::class, 'edit'])->name('client.products.edit');
        Route::put('/client/products/{product}', [\App\Http\Controllers\ClientProductController::class, 'update'])->name('client.products.update');
        Route::delete('/client/products/{product}', [\App\Http\Controllers\ClientProductController::class, 'destroy'])->name('client.products.delete');
        Route::post('/client/products/{product}/toggle-top', [\App\Http\Controllers\ClientProductController::class, 'toggleTop'])->name('client.products.toggle-top');
    });
});
