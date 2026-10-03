<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminInfrastructureController;
use App\Http\Controllers\AdminInquiryController;
use App\Http\Controllers\AdminMetroController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminProductItemController;
use App\Http\Controllers\AdminUniversityController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ClientProductController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeveloperCategoryController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\DeveloperInfrastructureController;
use App\Http\Controllers\DeveloperMetroController;
use App\Http\Controllers\DeveloperProductItemController;
use App\Http\Controllers\DeveloperUniversityController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductPhoneController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SmsNotificationController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Metro;
use App\Models\Product;
use App\Models\Region;
use App\Models\SubCategory;
use App\Models\University;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $regions = Region::with('cities')->get();
    $metros = Metro::orderBy('name')->get();
    $universities = University::orderBy('name')->get();
    $categories = Category::whereNotIn('name', ['admin'])->get();
    $propertyTypes = SubCategory::whereNotIn('name', ['nimadir', 'sadjasd', 'test 1 sub', '322'])
        ->select('name')
        ->distinct()
        ->pluck('name');

    $mapProducts = Product::with(['category', 'subCategory', 'region', 'city'])
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

    $topProducts = Product::with(['category', 'subCategory', 'region', 'city', 'metros', 'universities', 'items'])
        ->where('status', 'active')
        ->where('is_top', true)
        ->latest()
        ->take(8)
        ->get();

    $allActiveProducts = Product::with(['region', 'city'])->where('status', 'active')->get();
    
    $regionAnalytics = Region::with('cities')->get()->map(function ($region) use ($allActiveProducts) {
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

Route::get('/maniDashboard', [SearchController::class, 'maniDashboard'])->name('maniDashboard');
Route::get('/map', [SearchController::class, 'mapPage'])->name('map');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{product}/reveal-phone', [ProductPhoneController::class, 'reveal'])->name('products.reveal-phone');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

Route::get('/add-ad', function () {
    if (Auth::check()) {
        return redirect()->route('client.products.create');
    }
    session()->put('url.intended', route('client.products.create'));
    return redirect()->route('register')
        ->with('info', 'E\'lon joylashtirish uchun avval ro\'yxatdan o\'ting yoki mavjud hisobingizga kiring!');
})->name('add.ad');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
});

Route::post('/auth/send-code', [VerificationController::class, 'sendCode'])->name('auth.send-code');
Route::post('/auth/verify-code', [VerificationController::class, 'verifyCode'])->name('auth.verify-code');
Route::post('/auth/check-verification', [VerificationController::class, 'checkStatus'])->name('auth.check-verification');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/favorites/toggle/{product}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::post('/messages/read', [MessageController::class, 'markAsRead'])->name('messages.read');

    Route::get('/client/favorites', function() {
        return redirect()->route('client.dashboard', ['section' => 'favorites']);
    })->name('client.favorites');

    Route::middleware('role:dev')->group(function () {
        Route::get('/developer/dashboard', [DashboardController::class, 'developer'])->name('developer.dashboard');
        Route::get('/developer/users', [DeveloperController::class, 'users'])->name('developer.users');
        Route::get('/developer/users/create', [DeveloperController::class, 'createUser'])->name('developer.users.create');
        Route::post('/developer/users', [DeveloperController::class, 'storeUser'])->name('developer.users.store');
        Route::get('/developer/users/{user}/edit', [DeveloperController::class, 'editUser'])->name('developer.users.edit');
        Route::put('/developer/users/{user}', [DeveloperController::class, 'updateUser'])->name('developer.users.update');
        Route::delete('/developer/users/{user}', [DeveloperController::class, 'deleteUser'])->name('developer.users.delete');
        
        Route::get('/developer/products', [DeveloperController::class, 'products'])->name('developer.products');
        Route::post('/developer/products/{product}/toggle-top', [ClientProductController::class, 'toggleTop'])->name('developer.products.toggle-top');

        Route::get('/developer/roles', [DeveloperController::class, 'roles'])->name('developer.roles');
        Route::post('/developer/roles', [DeveloperController::class, 'storeRole'])->name('developer.roles.store');
        Route::get('/developer/roles/{role}/edit', [DeveloperController::class, 'editRole'])->name('developer.roles.edit');
        Route::put('/developer/roles/{role}', [DeveloperController::class, 'updateRole'])->name('developer.roles.update');
        Route::delete('/developer/roles/{role}', [DeveloperController::class, 'deleteRole'])->name('developer.roles.delete');

        Route::get('/developer/categories', [DeveloperCategoryController::class, 'index'])->name('developer.categories');
        Route::post('/developer/categories', [DeveloperCategoryController::class, 'storeCategory'])->name('developer.categories.store');
        Route::get('/developer/categories/{category}/edit', [DeveloperCategoryController::class, 'editCategory'])->name('developer.categories.edit');
        Route::put('/developer/categories/{category}', [DeveloperCategoryController::class, 'updateCategory'])->name('developer.categories.update');
        Route::delete('/developer/categories/{category}', [DeveloperCategoryController::class, 'deleteCategory'])->name('developer.categories.delete');

        Route::post('/developer/subcategories', [DeveloperCategoryController::class, 'storeSubCategory'])->name('developer.subcategories.store');
        Route::get('/developer/subcategories/{subCategory}/edit', [DeveloperCategoryController::class, 'editSubCategory'])->name('developer.subcategories.edit');
        Route::put('/developer/subcategories/{subCategory}', [DeveloperCategoryController::class, 'updateSubCategory'])->name('developer.subcategories.update');
        Route::delete('/developer/subcategories/{subCategory}', [DeveloperCategoryController::class, 'deleteSubCategory'])->name('developer.subcategories.delete');

        Route::get('/developer/infrastructure', [DeveloperInfrastructureController::class, 'index'])->name('developer.infrastructure');
        
        Route::post('/developer/metros', [DeveloperMetroController::class, 'store'])->name('developer.metros.store');
        Route::put('/developer/metros/{metro}', [DeveloperMetroController::class, 'update'])->name('developer.metros.update');
        Route::delete('/developer/metros/{metro}', [DeveloperMetroController::class, 'destroy'])->name('developer.metros.delete');

        Route::post('/developer/universities', [DeveloperUniversityController::class, 'store'])->name('developer.universities.store');
        Route::put('/developer/universities/{university}', [DeveloperUniversityController::class, 'update'])->name('developer.universities.update');
        Route::delete('/developer/universities/{university}', [DeveloperUniversityController::class, 'destroy'])->name('developer.universities.delete');

        Route::post('/developer/product-items', [DeveloperProductItemController::class, 'store'])->name('developer.product-items.store');
        Route::put('/developer/product-items/{productItem}', [DeveloperProductItemController::class, 'update'])->name('developer.product-items.update');
        Route::delete('/developer/product-items/{productItem}', [DeveloperProductItemController::class, 'destroy'])->name('developer.product-items.delete');

        Route::get('/developer/sms-notifications', [SmsNotificationController::class, 'developerIndex'])->name('developer.sms-notifications.index');
        Route::post('/developer/sms-notifications/balance', [SmsNotificationController::class, 'refreshBalance'])->name('developer.sms-notifications.balance');
    });

    Route::middleware('role:admin,manager')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

        Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->name('admin.categories');
        Route::post('/admin/categories', [AdminCategoryController::class, 'storeCategory'])->name('admin.categories.store');
        Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'editCategory'])->name('admin.categories.edit');
        Route::put('/admin/categories/{category}', [AdminCategoryController::class, 'updateCategory'])->name('admin.categories.update');
        Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'deleteCategory'])->name('admin.categories.delete');

        Route::post('/admin/subcategories', [AdminCategoryController::class, 'storeSubCategory'])->name('admin.subcategories.store');
        Route::get('/admin/subcategories/{subCategory}/edit', [AdminCategoryController::class, 'editSubCategory'])->name('admin.subcategories.edit');
        Route::put('/admin/subcategories/{subCategory}', [AdminCategoryController::class, 'updateSubCategory'])->name('admin.subcategories.update');
        Route::delete('/admin/subcategories/{subCategory}', [AdminCategoryController::class, 'deleteSubCategory'])->name('admin.subcategories.delete');

        Route::get('/admin/products', [AdminProductController::class, 'index'])->name('admin.products');
        Route::post('/admin/products/{product}/toggle-top', [ClientProductController::class, 'toggleTop'])->name('admin.products.toggle-top');
        Route::get('/admin/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
        Route::post('/admin/products', [AdminProductController::class, 'store'])->name('admin.products.store');
        Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/admin/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.delete');

        Route::get('/admin/infrastructure', [AdminInfrastructureController::class, 'index'])->name('admin.infrastructure');

        Route::post('/admin/metros', [AdminMetroController::class, 'store'])->name('admin.metros.store');
        Route::put('/admin/metros/{metro}', [AdminMetroController::class, 'update'])->name('admin.metros.update');
        Route::delete('/admin/metros/{metro}', [AdminMetroController::class, 'destroy'])->name('admin.metros.delete');

        Route::post('/admin/universities', [AdminUniversityController::class, 'store'])->name('admin.universities.store');
        Route::put('/admin/universities/{university}', [AdminUniversityController::class, 'update'])->name('admin.universities.update');
        Route::delete('/admin/universities/{university}', [AdminUniversityController::class, 'destroy'])->name('admin.universities.delete');

        Route::post('/admin/product-items', [AdminProductItemController::class, 'store'])->name('admin.product-items.store');
        Route::put('/admin/product-items/{productItem}', [AdminProductItemController::class, 'update'])->name('admin.product-items.update');
        Route::delete('/admin/product-items/{productItem}', [AdminProductItemController::class, 'destroy'])->name('admin.product-items.delete');

        Route::get('/admin/inquiries', [AdminInquiryController::class, 'index'])->name('admin.inquiries.index');
        Route::get('/admin/inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('admin.inquiries.show');
        Route::put('/admin/inquiries/{inquiry}', [AdminInquiryController::class, 'update'])->name('admin.inquiries.update');

        Route::get('/admin/sms-notifications', [SmsNotificationController::class, 'adminIndex'])->name('admin.sms-notifications.index');
        Route::post('/admin/sms-notifications/balance', [SmsNotificationController::class, 'refreshBalance'])->name('admin.sms-notifications.balance');
    });

    Route::post('/email/send-code', [EmailVerificationController::class, 'sendCode'])->name('email.send-code');
    Route::post('/email/verify-code', [EmailVerificationController::class, 'verifyCode'])->name('email.verify-code');

    Route::middleware('role:client,makler,owner,hotel,builder')->group(function () {
        Route::get('/client/dashboard', [DashboardController::class, 'client'])->name('client.dashboard');
        Route::put('/client/profile', [ClientProfileController::class, 'update'])->name('client.profile.update');
        
        Route::get('/client/products', [ClientProductController::class, 'index'])->name('client.products.index');
        Route::get('/client/products/create', [ClientProductController::class, 'create'])->name('client.products.create');
        Route::post('/client/products', [ClientProductController::class, 'store'])->name('client.products.store');
        Route::get('/client/products/{product}/edit', [ClientProductController::class, 'edit'])->name('client.products.edit');
        Route::put('/client/products/{product}', [ClientProductController::class, 'update'])->name('client.products.update');
        Route::delete('/client/products/{product}', [ClientProductController::class, 'destroy'])->name('client.products.delete');
        Route::post('/client/products/{product}/toggle-top', [ClientProductController::class, 'toggleTop'])->name('client.products.toggle-top');
    });
});
