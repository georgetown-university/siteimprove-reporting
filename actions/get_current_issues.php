<?php

require_once 'api.php';
require_once 'functions.php';

global $api;

$data = readSavedData();
$sites = getSites();

// Parse through every site.
foreach($sites as $site) {
  $site_name = $site['site_name'];

  // Add the site to the data array if it's not already in there.
  if (!array_key_exists($site_name, $data)) {
    $data[$site_name] = array();
    $data[$site_name]['pages'] = $site['pages'];
    $data[$site_name]['reports'] = array();
  }

  // Set up array for current report.
  $data[$site_name]['reports'][date('Y-m-d H:i:s')] = array();

  // Get current accessibility data for this site.
  $api_path = '/sites/' . $site['id'] . '/accessibility/pages';
  $current_data = makeAPICall($api_path);

  // Count number of A vs. AA vs. AAA issues.
  $a_issues = 0;
  $aa_issues = 0;
  $aaa_issues = 0;

  foreach($current_data['items'] as $page) {
    $a_issues += $page['a_issues'];
    $aa_issues += $page['aa_issues'];
    $aaa_issues += $page['aaa_issues'];
  }

  // Save issue data to data array.
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['a_issues'] = $a_issues;
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['aa_issues'] = $aa_issues;
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['aaa_issues'] = $aaa_issues;
}

writeSavedData(json_encode($data));
return true;
