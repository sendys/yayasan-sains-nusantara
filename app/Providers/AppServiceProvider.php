<?php

namespace App\Providers;

use App\Repositories\COA\COARepositories;
use App\Repositories\COA\COARepositoriesInterface;
use App\Repositories\Gudang\GudangRepositories;
use App\Repositories\Gudang\GudangRepositoriesInterface;
use App\Repositories\Kategori\KategoriRepositories;
use App\Repositories\Kategori\KategoriRepositoriesInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryImplement;
use App\Repositories\Satuan\SatuanRepositories;
use App\Repositories\Satuan\SatuanRepositoriesInterface;
use App\Repositories\Supplier\SupplierRepositories;
use App\Repositories\Supplier\SupplierRepositoriesInterface;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(SupplierRepositoriesInterface::class, SupplierRepositories::class);
        $this->app->bind(COARepositoriesInterface::class, COARepositories::class);
        $this->app->bind(GudangRepositoriesInterface::class, GudangRepositories::class);
        $this->app->bind(KategoriRepositoriesInterface::class, KategoriRepositories::class);
        $this->app->bind(SatuanRepositoriesInterface::class, SatuanRepositories::class);
        $this->app->bind(ProductRepository::class, ProductRepositoryImplement::class);

        // Brand Repository Binding
        $this->app->bind(
            \App\Repositories\Brand\BrandRepositoriesInterface::class,
            \App\Repositories\Brand\BrandRepositories::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Rate limiter for login attempts - 5 per minute per email+ip
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->input('email') . '|' . $request->ip())
                ->response(function () {
                    return response()->json([
                        'success' => false,
                        'message' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam 1 menit.',
                    ], 429);
                });
        });

        // Rate limiter for registration - 3 per minute per IP
        RateLimiter::for('registration', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip())
                ->response(function () {
                    return response()->json([
                        'success' => false,
                        'message' => 'Terlalu banyak percobaan registrasi. Silakan coba lagi dalam 1 menit.',
                    ], 429);
                });
        });

        // Rate limiter for API - 60 per minute per user or IP
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Rate limiter for password reset - 3 per minute per IP
        RateLimiter::for('password-reset', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip())
                ->response(function () {
                    return response()->json([
                        'success' => false,
                        'message' => 'Terlalu banyak permintaan reset password. Silakan coba lagi dalam 1 menit.',
                    ], 429);
                });
        });
    }
}
