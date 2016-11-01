<?php

namespace App\Models\Access\User;

use App\Models\Agent;
use App\Models\AgentHasUser;
use Illuminate\Notifications\Notifiable;
use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\Traits\Scope\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\UserSendPasswordReset;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;

/**
 * App\Models\Access\User\User
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $last_updated
 * @property \Carbon\Carbon $deleted_at
 * @property string $nickname
 * @property string $salutation
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $sha1_password
 * @property string $salt
 * @property bool $want_to_be_moderator
 * @property bool $is_moderator
 * @property bool $is_administrator
 * @property int $deletions
 * @property string $password
 * @property string $culture
 * @property string $remember_token
 * @property string $confirmation_code
 * @property string $name
 * @property bool $confirmed
 * @property bool $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Agent[] $Agents
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @property-read string $status_label
 * @property-read string $confirmed_label
 * @property-read mixed $picture
 * @property-read string $show_button
 * @property-read string $edit_button
 * @property-read string $change_password_button
 * @property-read string $status_button
 * @property-read string $confirmed_button
 * @property-read string $delete_button
 * @property-read string $restore_button
 * @property-read string $delete_permanently_button
 * @property-read string $login_as_button
 * @property-read string $action_buttons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Role\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\SocialLogin[] $providers
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereLastUpdated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereNickname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereSalutation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereSha1Password($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereSalt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereWantToBeModerator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereIsModerator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereIsAdministrator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereDeletions($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereCulture($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereConfirmationCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereConfirmed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User confirmed($confirmed = true)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User active($status = true)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use UserScope,
		UserAccess,
		Notifiable,
		SoftDeletes,
		UserAttribute,
		UserRelationship,
		UserSendPasswordReset;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
    protected $table = 'reg_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nickname', 'email', 'password', 'status', 'confirmation_code', 'confirmed'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

	/**
	 * @param array $attributes
	 */
	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);
		$this->table = config('access.users_table');
	}

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
