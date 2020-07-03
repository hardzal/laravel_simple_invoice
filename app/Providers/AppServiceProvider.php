<?php

namespace App\Providers;

use App\Models\InvoiceDetail;
use App\Observers\InvoiceDetailObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // InvoiceDetail adalah nama class dari Model
        // InvoiceDetailObserver adalah class dari observed
        InvoiceDetail::observe(InvoiceDetailObserver::class);
    }
}
