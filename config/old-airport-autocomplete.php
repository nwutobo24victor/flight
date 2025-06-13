<?php
require 'amadeus-token.php';
require_once 'utils.php';

if (!isset($_GET['q']) || strlen($_GET['q']) < 2) {
    echo json_encode([]);
    exit;
}

$keyword = htmlspecialchars($_GET['q']);
$token = get_amadeus_token();

$url = AMADEUS_BASE_URL . "/v1/reference-data/locations?" . http_build_query([
    'subType' => 'AIRPORT',
    'keyword' => $keyword,
    'countryCode' => 'NG',
    'page[limit]' => 15,
]);

$response = http_get($url, [
    "Authorization: Bearer $token"
]);

$results = [];
if (!empty($response['data'])) {
    foreach ($response['data'] as $airport) {
        $results[] = [
            'iataCode' => $airport['iataCode'],
            'name' => $airport['name'],
            'cityName' => $airport['address']['cityName'] ?? '',
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($results);
