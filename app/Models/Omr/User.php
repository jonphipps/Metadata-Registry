<?php

namespace App\Models\Omr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Omr\User
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $last_updated
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $nickname
 * @property string|null $salutation
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $sha1_password
 * @property string|null $salt
 * @property int|null $want_to_be_moderator
 * @property int|null $is_moderator
 * @property int|null $is_administrator
 * @property int|null $deletions
 * @property string|null $password
 * @property string|null $culture
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereCulture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereDeletions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereIsAdministrator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereIsModerator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereSalt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereSalutation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereSha1Password($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\User whereWantToBeModerator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql_omr';

    protected $table = self::TABLE;
    public const TABLE = 'reg_user';

    protected $dates = ['created_at', 'last_updated','deleted_at'];
    public $timestamps = false;

}
