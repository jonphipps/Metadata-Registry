<?php

namespace App\Models\Access\User;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Access\User\SocialLogin
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property string $token
 * @property string $avatar
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\SocialLogin whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\SocialLogin whereUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\SocialLogin whereProvider( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\SocialLogin whereProviderId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\SocialLogin whereToken( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\SocialLogin whereAvatar( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\SocialLogin whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\SocialLogin whereUpdatedAt( $value )
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
