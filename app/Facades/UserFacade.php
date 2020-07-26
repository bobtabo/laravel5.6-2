<?php
/**
 * ユーザーファサード
 */
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * ユーザーFacadeクラスです。
 *
 * @package App\Facades
 */
class UserFacade extends Facade
{
    /**
     * Facadeのアクセサを取得します。
     *
     * @return string アクセサ
     */
    protected static function getFacadeAccessor()
    {
        return 'user';
    }
}