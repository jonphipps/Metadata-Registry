<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Container\Container;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Export implements ShouldQueue
{
  use InteractsWithQueue, Queueable, SerializesModels;


  /**
   * Create a new job instance.
   *
   * @param \ExportHistory $export
   *
   * @throws \PropelException
   */
    public function __construct(\ExportHistory $export)
    {
      //new up a laravel container
        Container::setInstance(new Container);

        $addLanguage     = $export->getSelectedLanguage();
        $schema          = $export->getSchema();
        $vocabulary      = $export->getVocabulary();
        $defaultLanguage = $schema ? $schema->getLanguage() : $vocabulary->getLanguage();

        if ($addLanguage) {
            $languages = [ $defaultLanguage, $addLanguage, ];
        } else {
            $languages = [ $defaultLanguage, ];
        }
    }

  }


  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    //
  }
}
