<?php
// search-flights.php
require 'amadeus-token.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $origin = strtoupper(trim($_POST['origin']));
    $destination = strtoupper(trim($_POST['destination']));
    $departure_date = $_POST['departure_date'];

    $token = get_amadeus_token();
    if (!$token) {
        die("Failed to authenticate with Amadeus API.");
    }

    $url = AMADEUS_BASE_URL . "/v2/shopping/flight-offers?" . http_build_query([
        'originLocationCode' => $origin,
        'destinationLocationCode' => $destination,
        'departureDate' => $departure_date,
        'adults' => 1,
        'nonStop' => 'false',
        'max' => 5,
    ]);

    $flights = http_get($url, [
        "Authorization: Bearer $token"
    ]);


    // Check for errors in the response
    if (isset($flights['errors'])) {
        $errorMsg = $flights['errors'][0]['detail'] ?? 'Unknown error';
        die("Error: " . $errorMsg);
    } else {

        //pass the response to the client
        $data = ["status" => true, "message" => "Flight search results retrieved successfully.", "flight" => $flights['data'],];

        header('Content-Type: application/json');
        echo json_encode($data);
    }
} else {
    die("Invalid request method.");
}
