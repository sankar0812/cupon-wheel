<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class HttpsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
  //  public function boot(): void
   // {
        //
   // }

  public function boot() {
    if(config('app.env') === 'production') {
        URL::forceScheme('https');
    }
}
}
