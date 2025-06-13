<?php
// amadeus-token.php
require 'config.php';
require 'utils.php';

function get_amadeus_token()
{
    $url = AMADEUS_BASE_URL . '/v1/security/oauth2/token';

    $response = http_post($url, [
        'Content-Type: application/x-www-form-urlencoded'
    ], [
        'grant_type' => 'client_credentials',
        'client_id' => AMADEUS_CLIENT_ID,
        'client_secret' => AMADEUS_CLIENT_SECRET,
    ]);

    return isset($response['access_token']) ? $response['access_token'] : null;
}
