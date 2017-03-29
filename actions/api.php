<?php

// API data (url and authentication)
$api = array(
  'user' => 'jh1955@georgetown.edu',
  'key'  => '2f5250cc491b6654b294661c637dcb9e',
  'url'  => 'https://api.siteimprove.com/v2',
);

// General function to make API calls.
function makeAPICall($path) {
  global $api;

  $process = curl_init($api['url'] . $path);
  curl_setopt($process, CURLOPT_HTTPHEADER, array('Accept: application/json'));
  curl_setopt($process, CURLOPT_USERPWD, $api['user'] . ":" . $api['key']);
  curl_setopt($process, CURLOPT_RETURNTRANSFER, true);

  $response = curl_exec($process);
  curl_close($process);

  $json = json_decode($response, true);
  return $json;
}
