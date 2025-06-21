<?php
namespace App\Models;

use Google\Client;
use Google\Service\AnalyticsData;

class GoogleAnalyticsModel
{
    private $analytics;

    public function __construct()
    {
        $KEY_FILE_LOCATION = $_SERVER['DOCUMENT_ROOT'] . '/application/config/search-console-405219-7c117268868f.json';

        $client = new Client();
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->addScope('https://www.googleapis.com/auth/analytics.readonly');

        $this->analytics = new AnalyticsData($client);
    }

    public function getAnalyticsData()
    {
        $propertyId = '357149126'; // Replace with your Google Analytics Property ID

        $request = new AnalyticsData\RunReportRequest([
            'property' => 'properties/' . $propertyId,
            'dateRanges' => [
                ['startDate' => '30daysAgo', 'endDate' => 'today']
            ],
            'metrics' => [
                ['name' => 'activeUsers'],
                ['name' => 'screenPageViews'],
                ['name' => 'sessions']
            ]
        ]);

        $response = $this->analytics->properties->runReport($propertyId, $request);
        return $response->getRows();
    }
}
