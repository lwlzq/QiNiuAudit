<?php
/**
 * Copyright (C), 2021-2021, Shall Buy Life info. Co., Ltd.
 * FileName: AvatarProvider.php
 * Description: 说明
 *
 * @author lwl
 * @Create Date    2021/7/2 11:49
 * @Update Date    2021/7/2 11:49 By lwl
 * @version v1.0
 */
namespace Liuweiliang\Liuweiliang;
use Illuminate\Support\ServiceProvider;
class AvatarProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // 发布配置文件
        $this->publishes([
            __DIR__.'/config/avatar.php' => config_path('avatar.php'),
        ]);
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('avatar', function ($app) {
            return new Avatar($app['config']);
        });
    }
}