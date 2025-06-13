<?php
require 'amadeus-token.php';
require_once 'utils.php';

function fetchAirports($keyword, $country = null)
{
    $token = get_amadeus_token();
    if (!$token) return [];

    $params = [
        'subType'      => 'AIRPORT',
        'keyword'      => $keyword,
        'page[limit]'  => 20,
    ];
    if ($country) {
        $params['countryCode'] = $country;
    }

    $url = AMADEUS_BASE_URL . '/v1/reference-data/locations?' . http_build_query($params);
    $resp = http_get($url, ["Authorization: Bearer $token"]);

    return $resp['data'] ?? [];
}

if (!isset($_GET['q']) || strlen($_GET['q']) < 2) {
    echo json_encode([]);
    exit;
}

$keyword = htmlspecialchars($_GET['q']);
$data = fetchAirports($keyword, null);

if (empty($data)) {
    $data = fetchAirports($keyword); // fallback to global
}

$results = [];
foreach ($data as $airport) {
    if (!empty($airport['iataCode'])) {
        $results[] = [
            'iataCode' => $airport['iataCode'],
            'name'     => $airport['name'],
            'cityName' => $airport['address']['cityName'] ?? '',
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($results);
