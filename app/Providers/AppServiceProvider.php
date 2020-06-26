<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Braintree\Gateway;

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
        //
        // $gateway = new \Braintree\Gateway([
        //         'environment' => 'sandbox',
        //         'merchantId' => 'j5kyxqgqgmc7d65n',
        //         'publicKey' => 'j2smq9sghg76qfdy',
        //         'privateKey' => '917dcc7dbb9f8005bb6f061e0d0ed01d'
        //     ]);
    }
}
