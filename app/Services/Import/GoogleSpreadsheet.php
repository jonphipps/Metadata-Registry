<?php

/** Created by PhpStorm,  User: jonphipps,  Date: 2017-05-05,  Time: 5:57 PM */

namespace App\Services\Import;


use function base_path;
use function collect;
use Google\Spreadsheet\DefaultServiceRequest;
use Google\Spreadsheet\ServiceRequestFactory;
use Google\Spreadsheet\Worksheet;
use Google_Client;
use Google_Service_Sheets;
use Illuminate\Support\Collection;

class GoogleSpreadsheet
{
    private $service;
    private $worksheets;

    /** Google spreadsheet object has
     * a google services connection <— built with service
     * a URL <— input in constructor
     * an identifier <— gets from the URL
     * a collection of worksheets <— gets from service
     *
     * @param $sheetUrl
     */

    public function __construct($sheetUrl)
    {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('client_secret.json'));

        $client = new Google_Client;
        $client->useApplicationDefaultCredentials();
        $client->setApplicationName("Open Metadata Registry Import");
        $client->setScopes([ 'https://www.googleapis.com/auth/drive', 'https://spreadsheets.google.com/feeds', ]);

        $accessToken = $client->fetchAccessTokenWithAssertion()["access_token"];
        ServiceRequestFactory::setInstance(new DefaultServiceRequest($accessToken));
        $this->service = new Google_Service_Sheets($client);
        $this->setWorksheets($sheetUrl);
    }

    /**
     * @param $sheetUrl
     */
    private function setWorksheets($sheetUrl): void
    {
        // Get our spreadsheet: https://docs.google.com/spreadsheets/d/1fM26a68SScrDvIJfgtT4QS-Vmhxw_deNhBrPMmBWQkI/edit?usp=sharing
        //basically this is how you get each worksheet for processing
        $spreadsheetId = $this->getIdFromUrl($sheetUrl);
        $worksheets = $this->service->spreadsheets->get($spreadsheetId)->sheets;
        /** @var Worksheet $worksheet */
        foreach ($worksheets as $worksheet) {
            $this->worksheets[] = $worksheet->getproperties()->title;
        }
    }

    /**
     * @return Collection
     */
    public function getWorksheets(): Collection
    {
        return collect($this->worksheets);
    }

    private function getIdFromUrl($url)
    {
        preg_match('/[-\\w]{25,}/u', $url, $matches);
        return $matches[0];
    }

}
