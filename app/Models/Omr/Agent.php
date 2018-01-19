<?php

namespace App\Models\Omr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Omr\Agent
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon $last_updated
 * @property \Carbon\Carbon|null $deleted_at
 * @property string $org_email
 * @property string|null $org_name
 * @property string|null $ind_affiliation
 * @property string|null $ind_role
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $web_address
 * @property string|null $type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Agent onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereAddress1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereIndAffiliation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereIndRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereLastUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereOrgEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereOrgName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Agent whereWebAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Agent withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Omr\Agent withoutTrashed()
 * @mixin \Eloquent
 */
class Agent extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    protected $connection = 'mysql_omr';
    protected $table = self::TABLE;
    protected $dates = ['created_at', 'last_updated', 'deleted_at'];

    public const TABLE = 'reg_agent';
}
