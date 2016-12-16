<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Resource
 *
 * @mixin \Eloquent
 */
class Resource extends Model
{
  protected $table = self::TABLE;
  const TABLE = "resources";

  use SoftDeletes;

  protected $dates = [ 'deleted_at' ];

  public $fillable = [
      "metadata",
  ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
  protected $casts = [
      "metadata" => "string",
  ];

  public static $rules = [

  ];

}
