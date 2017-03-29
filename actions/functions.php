<?php

// API call to test list of all sites.
function getSites() {
  $sites = makeAPICall('/sites');
  return $sites['items'];
}

// Function to retrieve saved data file.
function readSavedData() {
  $data_file = fopen('../data/report_data.json', 'r');
  $data = fread($data_file, filesize('../data/report_data.json'));
  fclose($data_file);
  return json_decode($data, true);
}

// Function to write to saved data file.
function writeSavedData($data = '[]') {
  $data_file = fopen('../data/report_data.json', 'w');
  fwrite($data_file, $data);
  fclose($data_file);
}
