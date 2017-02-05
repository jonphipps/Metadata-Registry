<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Access\User\User;

/**
 * App\Models\FileImportHistory
 *
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property string $map     stores the serialized column map array
 * @property int $user_id
 * @property int $vocabulary_id
 * @property int $schema_id
 * @property string $file_name
 * @property string $source_file_name
 * @property string $file_type
 * @property int $batch_id
 * @property string $results stores the serialized results of the import
 * @property int $total_processed_count
 * @property int $error_count
 * @property int $success_count
 * @property int $token
 * @property-read \App\Models\Access\User\User $User
 * @property-read \App\Models\Vocabulary $Vocabulary
 * @property-read \App\Models\ElementSet $ElementSet
 * @property-read \App\Models\Batch $Batch
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ConceptAttributeHistory[] $ConceptAttributeHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ElementAttributeHistory[] $ElementAttributeHistory
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereMap( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereVocabularyId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereSchemaId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereFileName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereSourceFileName( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereFileType( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereBatchId( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereResults( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereTotalProcessedCount( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereErrorCount( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereSuccessCount( $value )
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FileImportHistory whereToken( $value )
 * @mixin \Eloquent
 */
class FileImportHistory extends Model
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


    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function Vocabulary()
    {
        return $this->belongsTo(\App\Models\Vocabulary::class, 'vocabulary_id', 'id');
    }


    public function ElementSet()
    {
        return $this->belongsTo(\App\Models\ElementSet::class, 'schema_id', 'id');
    }


    public function Batch()
    {
        return $this->belongsTo(\App\Models\Batch::class, 'batch_id', 'id');
    }


    public function ConceptAttributeHistory()
    {
        return $this->hasMany(\App\Models\ConceptAttributeHistory::class, 'import_id', 'id');
    }


    public function ElementAttributeHistory()
    {
        return $this->hasMany(\App\Models\ElementAttributeHistory::class, 'import_id', 'id');
    }
}
