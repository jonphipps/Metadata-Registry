<?php

namespace App\Models\Omr;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Omr\Import
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property string|null $map stores the serialized column map array
 * @property int|null $user_id
 * @property int|null $vocabulary_id
 * @property int|null $schema_id
 * @property string|null $file_name
 * @property string|null $source_file_name
 * @property string|null $file_type
 * @property int|null $batch_id
 * @property string|null $results stores the serialized results of the import
 * @property int|null $total_processed_count
 * @property int|null $error_count
 * @property int|null $success_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereBatchId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereErrorCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereMap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereResults($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereSchemaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereSourceFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereSuccessCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereTotalProcessedCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Omr\Import whereVocabularyId($value)
 * @mixin \Eloquent
 */
class Import extends Model
{
    public $timestamps = false;
    protected $connection = 'mysql_omr';
    protected $table = self::TABLE;
    protected $dates = ['created_at'];

    public const TABLE = 'reg_file_import_history';
}
