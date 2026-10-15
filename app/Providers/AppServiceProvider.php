<?php

namespace App\Providers;

use App\Models\Lead;
use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // "2 soat avval" kabi sanalar o'zbek (lotin) tilida chiqsin
        \Carbon\Carbon::setLocale('uz_Latn');

        Relation::morphMap([
            'lead' => Lead::class,
            'product' => Product::class,
        ]);
    }
}
