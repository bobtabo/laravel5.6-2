<?php
/**
 * ユーザーサービスプロバイダー
 */
namespace App\Services\User;

use Illuminate\Support\ServiceProvider;

/**
 * ユーザーServiceProviderクラスです。
 *
 * @author Satoshi Nagashiba <bobtabo.buhibuhi@gmail.com>
 * @package App\Domains\Acceptance
 */
class UserServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton('user', function ($app) {
            return new UserService($app);
        });
    }

    public function provides()
    {
        return ['user'];
    }
}
