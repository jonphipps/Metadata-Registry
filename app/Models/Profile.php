<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'profile';

    use SoftDeletes;

  /*********************************
   * relationships
   **********************************/

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'status_id', 'id');
    }


    public function profileProperties()
    {
        return $this->hasMany(\App\Models\ProfileProperty::class, 'profile_id', 'id');
    }


    public function elementSets()
    {
        return $this->hasMany(\App\Models\ElementSet::class, 'profile_id', 'id');
    }


    public function vocabularies()
    {
        return $this->hasMany(\App\Models\Vocabulary::class, 'profile_id', 'id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }


  /*********************************
   * lookup functions
   **********************************/

    public function requiredProperties()
    {
        return $this->ProfileProperties()->whereIsRequired(true)->get();
    }
}
