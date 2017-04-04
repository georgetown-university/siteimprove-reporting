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
  $api_path = '/sites/' . $site['id'] . '/accessibility/issues';
  $current_data = makeAPICall($api_path);

  // Count numbers of issues by conformance level and severity.
  $a_error = 0;
  $a_review = 0;
  $a_warning = 0;
  $aa_error = 0;
  $aa_review = 0;
  $aa_warning = 0;
  $aaa_error = 0;
  $aaa_review = 0;
  $aaa_warning = 0;

  foreach($current_data['items'] as $item) {
    switch ($item['conformance_level']) {
      // A-level issues
      case 'a':
        switch ($item['severity']) {
          case 'error':
            $a_error += $item['pages'];
            break;
          case 'review':
            $a_review += $item['pages'];
            break;
          case 'warning':
            $a_warning += $item['pages'];
            break;
        }
        break;

      // AA-level issues
      case 'aa':
        switch ($item['severity']) {
          case 'error':
            $aa_error += $item['pages'];
            break;
          case 'review':
            $aa_review += $item['pages'];
            break;
          case 'warning':
            $aa_warning += $item['pages'];
            break;
        }
        break;

      // AAA-level issues
      case 'aaa':
        switch ($item['severity']) {
          case 'error':
            $aaa_error += $item['pages'];
            break;
          case 'review':
            $aaa_review += $item['pages'];
            break;
          case 'warning':
            $aaa_warning += $item['pages'];
            break;
        }
        break;
      }
  }

  // Save issue data to data array.
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['a_error'] = $a_error;
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['a_review'] = $a_review;
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['a_warning'] = $a_warning;

  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['aa_error'] = $aa_error;
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['aa_review'] = $aa_review;
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['aa_warning'] = $aa_warning;

  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['aaa_error'] = $aaa_error;
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['aaa_review'] = $aaa_review;
  $data[$site_name]['reports'][date('Y-m-d H:i:s')]['aaa_warning'] = $aaa_warning;
}

writeSavedData(json_encode($data));
return true;
