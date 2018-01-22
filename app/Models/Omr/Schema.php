<?php

namespace App\Models\Omr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Omr\Schema.
 *
 * @property int $id
 * @property int $agent_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $created_user_id
 * @property int|null $updated_user_id
 * @property string|null $child_updated_at
 * @property int|null $child_updated_user_id
 * @property string|null $name
 * @property string|null $note
 * @property string $uri
 * @property string|null $url
 * @property string $base_domain
 * @property string $token
 * @property string|null $community
 * @property int|null $last_uri_id
 * @property int $status_id
 * @property string $language
 * @property int|null $profile_id
 * @property string $ns_type
 * @property string|null $prefixes
 * @property string|null $languages
 * @property string $repo
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Schema onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereBaseDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereChildUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereCommunity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereLastUriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereNsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema wherePrefixes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereRepo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Schema whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Schema withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Schema withoutTrashed()
 * @mixin \Eloquent
 */
class Schema extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql_omr';
    protected $table      = self::TABLE;
    protected $dates      = ['deleted_at'];

    public const TABLE = 'reg_schema';
}
