<?php

namespace App\Models\Omr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Omr\Vocabulary
 *
 * @property int $id
 * @property int $agent_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon $last_updated
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
 * @property int $status_id This will be the default status id for all concept properties for this vocabulary
 * @property string $language This is the default language for all concept properties
 * @property string|null $languages
 * @property int|null $profile_id
 * @property string $ns_type
 * @property string|null $prefixes
 * @property string|null $repos
 * @property string|null $repo
 * @property string $prefix
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Vocabulary onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereBaseDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereChildUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereCommunity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereCreatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereLastUriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereNsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary wherePrefix($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary wherePrefixes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereRepo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereRepos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereUpdatedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Vocabulary whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Vocabulary withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Vocabulary withoutTrashed()
 * @mixin \Eloquent
 */
class Vocabulary extends Model
{
    use SoftDeletes;
    public $timestamps    = false;
    protected $connection = 'mysql_omr';
    protected $table      = self::TABLE;
    protected $dates      = ['created_at', 'last_updated', 'deleted_at'];

    public const TABLE = 'reg_vocabulary';
}
