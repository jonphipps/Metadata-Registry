<?php

namespace App\Jobs;

use App\Models\Export;
use App\Services\Import\DataImporter;
use App\Services\Import\GoogleSpreadsheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use const EXTR_OVERWRITE;
use function collect;
use function extract;

class importVocabulary implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Export
     */
    private $export;
    /**
     * @var string
     */
    private $worksheet_id;
    /**
     * @var array
     */
    private $spreadsheet;

    public function __construct(Export $export, string $worksheet_id, array $spreadsheet)
    {
        $this->export       = $export;
        $this->worksheet_id = $worksheet_id;
        $this->spreadsheet  = $spreadsheet;
    }

    /**
     * Execute the job.
     *
     */
    public function handle()
    {
        $source_file_name = '';
        $import_type = 0;
        extract($this->$this->spreadsheet, EXTR_OVERWRITE);
        $sheet = new GoogleSpreadsheet($source_file_name);
        $data     = collect($sheet->getWorksheetData($this->worksheet_id)->toArray());
        //TODO: Handle $import_type in the importer
        $importer = new DataImporter($data, $this->export);
        //then we pass them to the importer
        $changeSet = $importer->getChangeset();
    }
}
