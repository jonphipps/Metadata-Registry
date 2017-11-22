<?php namespace App\Models;

use App\Helpers\Macros\Traits\Languages;
use App\Models\Traits\HasStatus;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property string|null $child_updated_at
 * @property int|null $child_updated_by
 * @property string $name
 * @property string|null $note
 * @property string $uri
 * @property string|null $url
 * @property string $base_domain
 * @property string $token
 * @property string|null $community
 * @property int|null $last_uri_id
 * @property int $status_id
 * @property string $language
 * @property-read \App\Models\Access\User\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Elementset[] $elementsets
 * @property-read \App\Models\Access\User\User|null $eraser
 * @property-read mixed $current_language
 * @property-read mixed $default_language
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProfileProperty[] $profile_properties
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Project[] $projects
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Access\User\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Vocabulary[] $vocabularies
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereBaseDomain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereChildUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereChildUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCommunity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereLastUriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Profile whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile withoutTrashed()
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

    public function profile_properties(): ?HasMany
    {
        return $this->hasMany( \App\Models\ProfileProperty::class, 'profile_id', 'id' );
    }

    public function elementsets(): ?HasMany
    {
        return $this->hasMany( \App\Models\Elementset::class, 'profile_id', 'id' );
    }

    public function vocabularies(): ?HasMany
    {
        return $this->hasMany( \App\Models\Vocabulary::class, 'profile_id', 'id' );
    }

    public function projects(): ?BelongsToMany
    {
        return $this->belongsToMany( Project::class );
    }

    /*********************************
     * lookup functions
     **********************************/

    public function required_properties(): ?Collection
    {
        return $this->profile_properties()->whereIsRequired( true )->get();
    }

    public function getColumnMapFromHeader(string $header): array
    {
        //parse the label from the string
        $test     = ltrim($header, '*');
        $test     = explode('_', $test);
        $language = $test[1] ?? '';
        $label    = explode('[', $test[0])[0];
        //get the property by looking up the label
        $profile = $this->profile_properties()->where('label', $label)->first();

        //return the property id, the label, and the language
        return [ 'id' => $profile? $profile->id: '', 'label' => $header, 'language' => $language ];
    }
}
