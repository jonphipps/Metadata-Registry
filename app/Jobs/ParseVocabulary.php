<?php

namespace App\Jobs;

use App\Events\ImportParseFinished;
use App\Models\Import;
use App\Services\Import\DataImporter;
use App\Services\Import\GoogleSpreadsheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use const EXTR_OVERWRITE;
use function collect;
use function extract;

class ParseVocabulary implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels, Dispatchable;
    /**
     * @var Import
     */
    private $import;
    /**
     * @var string
     */
    private $worksheet_id;
    /**
     * @var array
     */
    private $spreadsheet;

    public function __construct(Import $import, string $worksheet_id, array $spreadsheet)
    {
        $this->import       = $import;
        $this->worksheet_id = $worksheet_id;
        $this->spreadsheet  = $spreadsheet;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $source_file_name = '';
        $import_type      = 0;
        extract($this->spreadsheet, EXTR_OVERWRITE);
        $sheet    = new GoogleSpreadsheet($source_file_name);
        $data     = collect($sheet->getWorksheetData($this->worksheet_id)->toArray());
        //TODO: Handle $import_type in the importer
        $importer = new DataImporter($data, $this->import->export);
        //then we pass them to the importer
        $changeSet                  = $importer->getChangeset();
        $this->import->instructions = $changeSet;
        $this->import->preprocess   = $importer->getStats();
        $this->import->errors       = $importer->getErrors()->toJson();
        $this->import->save();

        event(new ImportParseFinished($this->import));
    }
}
