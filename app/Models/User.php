<?php
/**
 * ユーザーモデル
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * ユーザーModelクラスです。
 *
 * @package App\Models
 */
class User extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}