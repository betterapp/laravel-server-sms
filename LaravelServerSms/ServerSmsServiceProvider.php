<?php

namespace betterapp\LaravelServerSms;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class ServerSmsServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/config/server-sms.php' => config_path('server-sms.php'),]);
        }
    }
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ServerSms::class, function (Application $app) {
            return new ServerSms();
        });
    }
}
