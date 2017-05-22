<?php namespace App\Models;

use App\Models\Access\User\User;
use App\Models\Traits\ElementSets;
use App\Models\Traits\Profiles;
use App\Models\Traits\Vocabularies;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Matryoshka\Cacheable;

class Project extends Model
{
    use CrudTrait, Cacheable, SoftDeletes, Profiles, Vocabularies, ElementSets;

    const TABLE = 'reg_agent';

    public static $rules = [];

    protected $table = self::TABLE;

    protected $dates = [ 'deleted_at' ];

    protected $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    protected $hidden = [];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function badge( $count )
    {
        return '<span class="badge">' . $count . '</span>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members()
    {
        return $this->belongsToMany( User::class )->withPivot( 'is_registrar_for', 'is_admin_for' )->withTimestamps();
    }




    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function ScopePrivate( $query )
    {
        return $query->where( 'is_private', true );
    }

    /**
     * @param Builder $query
     *
     * @return mixed
     */
    public function ScopePublic( $query )
    {
        return $query->where( 'is_private', '<>', 1 );
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function getTitleAttribute()
    {
        return $this->attributes['org_name'];
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setTitleAttribute(string $value)
    {
        $this->attributes['org_name'] = $value;
    }

}
