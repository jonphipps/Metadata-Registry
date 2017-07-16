<?php

namespace App\Models\Access\User;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Access\User\SocialLogin
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $provider
 * @property string|null $provider_id
 * @property string|null $token
 * @property string|null $avatar
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\SocialLogin whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\SocialLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\SocialLogin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\SocialLogin whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\SocialLogin whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\SocialLogin whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\SocialLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\SocialLogin whereUserId($value)
 * @mixin \Eloquent
 */
class SocialLogin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = self::TABLE;
    const TABLE = 'social_logins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'user_id', 'provider', 'provider_id', 'token', 'avatar' ];
}
