<?php

namespace App\Providers;

use App\Models\Subscriber;
use App\Observers\SubscriberObserver;
use Illuminate\Support\ServiceProvider;

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
        Subscriber::observe(SubscriberObserver::class);
    }
}
