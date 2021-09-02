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
class QiNiuAuditProvider extends ServiceProvider
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
            __DIR__ . '/config/qiniu.php' => config_path('qiniu.php'),
        ]);
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('qiNiuAudit', function ($app) {
            return new Avatar($app['config']);
        });
    }
}