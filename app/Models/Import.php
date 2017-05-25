<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\Import
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $source_file_name
 * @property string $source
 * @property string $map stores the serialized column map array
 * @property int $user_id
 * @property string $file_name
 * @property string $file_type
 * @property string $results stores the serialized results of the import
 * @property int $total_processed_count
 * @property int $error_count
 * @property int $success_count
 * @property int $batch_id
 * @property int $vocabulary_id
 * @property int $schema_id
 * @property int $token
 * @property-read \App\Models\Batch $batch
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttributeHistory[] $conceptAttributeHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttributeHistory[] $elementAttributeHistory
 * @property-read \App\Models\Elementset $elementset
 * @property-read \App\Models\Access\User\User $user
 * @property-read \App\Models\Vocabulary $vocabulary
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereBatchId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereErrorCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereFileName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereFileType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereMap($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereResults($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereSchemaId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereSourceFileName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereSuccessCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereTotalProcessedCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Import whereVocabularyId($value)
 * @mixin \Eloquent
 */
class Import extends Model
{
    protected $table = self::TABLE;
    const TABLE = 'reg_file_import_history';

    protected $fillable = [
      'map',
      'file_name',
      'source_file_name',
      'file_type',
      'results',
      'total_processed_count',
      'error_count',
      'success_count',
    ];

  /**
   * The attributes that should be casted to native types.
   *
   * @var array
   */
    protected $casts = [
      "id"                    => "integer",
      "map"                   => "string",
      "user_id"               => "integer",
      "vocabulary_id"         => "integer",
      "schema_id"             => "integer",
      "file_name"             => "string",
      "source_file_name"      => "string",
      "file_type"             => "string",
      "batch_id"              => "integer",
      "results"               => "string",
      "total_processed_count" => "integer",
      "error_count"           => "integer",
      "success_count"         => "integer",
    ];

    public static $rules = [
      "map"              => "max:65535",
      "file_name"        => "max:255",
      "source_file_name" => "max:255",
      "file_type"        => "max:30",
      "results"          => "max:65535",
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function vocabulary()
    {
        return $this->belongsTo(\App\Models\Vocabulary::class, 'vocabulary_id', 'id');
    }


    public function elementset()
    {
        return $this->belongsTo(\App\Models\Elementset::class, 'schema_id', 'id');
    }


    public function batch()
    {
        return $this->belongsTo(\App\Models\Batch::class, 'batch_id', 'id');
    }


    public function conceptAttributeHistory()
    {
        return $this->hasMany(\App\Models\ConceptAttributeHistory::class, 'import_id', 'id');
    }


    public function elementAttributeHistory()
    {
        return $this->hasMany(\App\Models\ElementAttributeHistory::class, 'import_id', 'id');
    }
}
