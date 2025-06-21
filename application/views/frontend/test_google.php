<?php
require 'vendor/autoload.php';

use Google\Client;

$KEY_FILE_LOCATION = $_SERVER['DOCUMENT_ROOT'] . '/application/config/search-console-405219-7c117268868f.json';

$client = new Google_Client();
$client->setAuthConfig($KEY_FILE_LOCATION);
$client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

try {
    $service = new Google_Service_Analytics($client);
    echo "Google API Connected Successfully!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
