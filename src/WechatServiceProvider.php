<?php

namespace Qihucms\Wechat;

use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Wechat::class, function () {
            return new Wechat();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

//        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'wechat');

        $this->publishes([
            __DIR__.'/../config/qh_wechat.php' => config_path('qh_wechat.php'),
//            __DIR__ . '/../resources/views' => resource_path('views/vendor/wechat'),
        ]);
    }
}
