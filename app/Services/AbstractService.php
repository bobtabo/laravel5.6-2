<?php
/**
 * 基底サービス
 */
namespace App\Services;

use Illuminate\Foundation\Application;

/**
 * 基底Serviceクラスです。
 *
 * @package App\Services
 */
abstract class AbstractService
{
    /**
     * アプリケーション
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app = null;

    /**
     * コンストラクタ。
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
}
