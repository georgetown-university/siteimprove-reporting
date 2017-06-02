<?php

require_once 'api.php';
require_once 'functions.php';

global $api;

$data = readSavedData();
$sites = getSites();
$date = date('Y-m-d H:i:s');

// Parse through every site.
foreach($sites as $site) {
  $site_name = setupSite($site);

  // Get current accessibility data for this site.
  $api_path = '/sites/' . $site['id'] . '/accessibility/issues';
  error_log($api_path);

  // Get the first page of data.
  $page_num = 1;
  $current_data = makeAPICall($api_path . '?page=' . $page_num);

  $total_pages = getTotalPages($current_data);
  $issues = initIssues();

  // Get all the data for all the pages of data
  while ($page_num <= $total_pages) {
    if (array_key_exists('items', $current_data)) {
      foreach($current_data['items'] as $item) {
        $issues = getIssues($item, $issues);
      }
    }

    $page_num++;
    $current_data = makeAPICall($api_path . '?page=' . $page_num);
  }

  saveIssueData($site_name, $issues);
}

writeSavedData(json_encode($data));
return true;
