<?php
/**
 * Plain PHP simple script to parse web page
 */

require __DIR__ . '/vendor/autoload.php';

use App\HttpClient\Drivers\Curl;
use App\HttpClient\HttpClient;
use App\Parsers\LinksParser;


$parseThisUrl = 'http://example.com/';

//Using curl as HTTP client driver
$curl = new Curl;
$httpClient = new HttpClient($curl);

//Getting page
$html = $httpClient->get($parseThisUrl);

//Parsing it
$parser = new LinksParser($html);

$links = $parser->parse();

//Saving results to json file
$jsonLinks = json_encode($links);

$filePath = getcwd() . "/links_on_" . time() . ".json";

file_put_contents($filePath, $jsonLinks);

echo "All is done. Result in file: $filePath" . PHP_EOL;