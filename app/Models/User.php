<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property string $last_updated
 * @property string $nickname
 * @property string $salutation
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $sha1_password
 * @property string $salt
 * @property boolean $want_to_be_moderator
 * @property boolean $is_moderator
 * @property boolean $is_administrator
 * @property integer $deletions
 * @property string $password
 * @property string $culture
 * @property string $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Agent[] $Agents
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastUpdated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereSalutation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereSha1Password($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereSalt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWantToBeModerator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsModerator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsAdministrator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCulture($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'reg_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Agents()
    {
        return $this->belongsToMany(Agent::class, AgentHasUser::TABLE)
                    ->withPivot('is_registrar_for', 'is_admin_for')
                    ->withTimestamps();
    }

}
