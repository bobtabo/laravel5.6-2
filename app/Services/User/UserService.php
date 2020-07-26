<?php
/**
 * ユーザーサービス
 */
namespace App\Services\User;

use App\Services\AbstractService;
use Illuminate\Support\Collection;
use App\Models\User as UserModel;
/**
 * ユーザーServiceクラスです。
 *
 * @package App\Domains\Acceptance
 */
class UserService extends AbstractService
{
    public function getUsers(): Collection
    {
        return UserModel::all();
    }
}