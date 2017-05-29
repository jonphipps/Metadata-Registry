<?php

use Illuminate\Database\Migrations\Migration;
use Ixudra\Wizard\Repositories\Eloquent\EloquentFlowRepository;

/** @noinspection AutoloadingIssuesInspection */
class CreateImportFlows extends Migration
{
    public function up()
    {
        $config = [
            'handler' => 'App\Flows\GsImport\FlowHandler',
            'steps'   => [
                'spreadsheet' => [
                    'handler' => 'App\Flows\GsImport\Steps\Spreadsheet',
                ],
                'worksheets'  => [
                    'handler' => 'App\Flows\GsImport\Steps\Worksheets',
                ],
                'approve'     => [
                    'handler' => 'App\Flows\GsImport\Steps\Approve',
                ],
                'import'      => [
                    'handler' => 'App\Flows\GsImport\Steps\Import',
                ],
            ],
        ];

        DB::table('flows')->insert([
                'name'   => 'gsimport',
                'config' => json_encode($config),
            ]);
    }

    public function down()
    {
        $flowRepository = App::make(EloquentFlowRepository::class);
        $flow           = $flowRepository->findByName('gsimport');
        if (null !== $flow) {
            $flow->delete();
        }
    }
}
