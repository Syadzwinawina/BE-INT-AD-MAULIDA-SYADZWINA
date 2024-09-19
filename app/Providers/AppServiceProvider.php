<?php

// namespace App\Providers;

// use Illuminate\Support\ServiceProvider;

// class AppServiceProvider extends ServiceProvider
// {
//     /**
    //  * Register any application services.
    //  */
    // public function register(): void
    // {
    //     //
    // }

    // /**
    //  * Bootstrap any application services.
    //  */
    // public function boot(): void
//     {
//         //
//     }
// }


namespace App\Providers;

use Illuminate\Support\Facades\Schema; /* add here */
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191); /* add here */
    }
    
    /* ... */
    
}
