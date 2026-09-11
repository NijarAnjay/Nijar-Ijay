<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\User;
use App\Policies\DashboardPolicy;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Jenis;
use App\Models\ItemPenjualan;
use App\Policies\ItemPenjualanPolicy;
use App\Policies\PenjualPolicy;
use App\Policies\ProdukPolicy;
use App\Policies\JenisPolicy;

class AppServiceProvider extends AuthServiceProvider
{
    protected $policies = [
        User::class => DashboardPolicy::class,
        Produk::class => ProdukPolicy::class,
        Jenis::class => JenisPolicy::class,
        Penjualan::class => PenjualPolicy::class,
        ItemPenjualan::class => ItemPenjualanPolicy::class
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Carbon::setLocale('id');
        $this->registerPolicies();
    }
}
