<?php

namespace App\Models\Access\User;

use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;
use App\Models\Access\User\Traits\Scope\UserScope;
use App\Models\Access\User\Traits\UserAccess;
use App\Models\Access\User\Traits\UserSendPasswordReset;
use App\Models\Elementset;
use App\Models\ElementsetUser;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Vocabulary;
use App\Models\VocabularyUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Access\User\User
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property string|null $nickname
 * @property string|null $salutation
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property int|null $is_administrator
 * @property string|null $password
 * @property int $status
 * @property string|null $culture
 * @property string|null $confirmation_code
 * @property string $name
 * @property int $confirmed
 * @property string|null $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Elementset[] $elementsets
 * @property-read string $action_buttons
 * @property-read string $change_password_button
 * @property-read string $clear_session_button
 * @property-read string $confirmed_button
 * @property-read string $confirmed_label
 * @property-read string $delete_button
 * @property-read string $delete_permanently_button
 * @property-read string $edit_button
 * @property-read string $full_name
 * @property-read mixed $github_token
 * @property-read string $login_as_button
 * @property-read mixed $picture
 * @property-read string $restore_button
 * @property-read string $show_button
 * @property-read string $status_button
 * @property-read string $status_label
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\SocialLogin[] $providers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\Role\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\System\Session[] $sessions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Access\User\SocialLogin[] $socialLogins
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $vocabularies
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User active($status = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User confirmed($confirmed = true)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereConfirmationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereCulture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereIsAdministrator($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereSalutation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Access\User\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Access\User\User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use UserScope, UserAccess, Notifiable, SoftDeletes, UserAttribute, UserRelationship, UserSendPasswordReset;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table   = self::TABLE;
    public const TABLE = 'users';
    protected $guarded = ['id', 'is_administrator'];
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

    public function isAdminForProjectId(int $project_id): bool
    {
        return (bool) ProjectUser::where([
            ['user_id', '=', $this->id],
            ['agent_id', '=', $project_id],
            ['is_admin_for', '=', true],
        ])->count();
    }

    public function isAdminForVocabulary(Vocabulary $vocabulary): bool
    {
        return (bool) VocabularyUser::where([
                ['user_id', '=', $this->id],
                ['is_admin_for', '=', true],
            ])->count() or $this->isAdminForProjectId($vocabulary->agent_id);
    }

    public function isMaintainerForVocabulary(Vocabulary $vocabulary): bool
    {
        return (bool) VocabularyUser::where([
                ['user_id', '=', $this->id],
                ['is_maintainer_for', '=', true],
            ])->count() or $this->isAdminForVocabulary($vocabulary);
    }

    public function isAdminForElementSet(Elementset $elementset): bool
    {
        return (bool) ElementsetUser::where([
                ['user_id', '=', $this->id],
                ['is_admin_for', '=', true],
            ])->count() or $this->isAdminForProjectId($elementset->agent_id);
    }

    public function isMaintainerForElementSet(Elementset $elementset): bool
    {
        return (bool) ElementsetUser::where([
                ['user_id', '=', $this->id],
                ['is_maintainer_for', '=', true],
            ])->count() or $this->isAdminForElementSet($elementset);
    }

    public function isMemberOfProject(Project $project): bool
    {
        return (bool) $this->projects()->wherePivot('agent_id', $project->id)->count();
    }

    public function projects(): ?BelongsToMany
    {
        return $this->belongsToMany(Project::class, ProjectUser::TABLE, 'user_id', 'agent_id')
            ->withPivot('is_registrar_for', 'is_admin_for', 'is_maintainer_for', 'authorized_as', 'languages')
            ->withTimestamps();
    }

    public function vocabularies(): ?BelongsToMany
    {
        return $this->belongsToMany(Vocabulary::class,
            VocabularyUser::TABLE,
            'user_id',
            'vocabulary_id')->withPivot('is_maintainer_for',
            'is_registrar_for',
            'is_admin_for',
            'languages',
            'default_language',
            'current_language')->withTimestamps();
    }

    public function elementsets(): ?BelongsToMany
    {
        return $this->belongsToMany(Elementset::class,
            ElementsetUser::TABLE,
            'user_id',
            'schema_id')->withPivot('is_registrar_for', 'is_admin_for', 'is_maintainer_for')->withTimestamps();
    }

    public function getGithubTokenAttribute()
    {
        if ($this->githubLogin()) {
            return $this->githubLogin()->token;
        }
    }

    public function githubLogin()
    {
        return $this->socialLogins()->where('provider', '=', 'github')->first();
    }

    public function socialLogins()
    {
        return $this->hasMany(SocialLogin::class, 'user_id');
    }

    /**
     * @param Collection|array $purgeKeys is a collection or array of user ids to purge from the list
     *
     * @return Collection of id -> nickname (user name) key:value pairs
     */
    public static function getUsersForSelect($purgeKeys = []): Collection
    {
        return self::orderBy('nickname')->get(['id', 'nickname', 'first_name', 'last_name'])->mapWithKeys(function ($item) {
            return [$item['id'] => self::getCombinedName($item)];
        })->diffKeys($purgeKeys);
    }

    public static function getCombinedName($user)
    {
        $name = trim($user['first_name'] . ' ' . $user['last_name']);

        return $name ? $user['nickname'] . ' (' . $name . ')' : $user['nickname'];
    }
}
