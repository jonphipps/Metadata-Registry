<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property string $child_updated_at
 * @property int $child_updated_by
 * @property string $name
 * @property string $note
 * @property string $uri
 * @property string $url
 * @property string $base_domain
 * @property string $token
 * @property string $community
 * @property int $last_uri_id
 * @property int $status_id
 * @property string $language
 * @property-read \App\Models\Access\User\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Elementset[] $elementsets
 * @property-read \App\Models\Access\User\User $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProfileProperty[] $profile_properties
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $vocabularies
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereBaseDomain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereChildUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCommunity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereLanguage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereLastUriId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUri($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUrl($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    const TABLE = 'profile';
    protected $table = self::TABLE;
    use SoftDeletes, Blameable, CreatedBy, UpdatedBy, DeletedBy;
    use Languages, HasStatus;
    protected $blameable = [
        'created' => 'created_by',
        'updated' => 'updated_by',
        'deleted' => 'deleted_by',
    ];
    protected $dates = [ 'deleted_at' ];
    protected $guarded = [ 'id' ];

    /*********************************
     * relationships
     **********************************/

    public function profile_properties()
    {
        return $this->hasMany( \App\Models\ProfileProperty::class, 'profile_id', 'id' );
    }

    public function elementsets()
    {
        return $this->hasMany( \App\Models\Elementset::class, 'profile_id', 'id' );
    }

    public function vocabularies()
    {
        return $this->hasMany( \App\Models\Vocabulary::class, 'profile_id', 'id' );
    }

    public function projects()
    {
        return $this->belongsToMany( Project::class );
    }

    /*********************************
     * lookup functions
     **********************************/

    public function required_properties()
    {
        return $this->profile_properties()->whereIsRequired( true )->get();
    }
}
