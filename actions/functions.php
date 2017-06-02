<?php

/* ***
 * API call to test list of all sites.
 */
function getSites() {
  $sites = makeAPICall('/sites');
  return $sites['items'];
  // $slice = array_slice($sites['items'], 0, 1, true);
  // return $slice;
}


/* ***
 * Retrieves saved data file.
 */
function readSavedData() {
  $data_file = fopen('../data/report_data.json', 'r');
  $data = fread($data_file, filesize('../data/report_data.json'));
  fclose($data_file);
  return json_decode($data, true);
}


/* ***
 * Writes to saved data file.
 */
function writeSavedData($data = '[]') {
  $data_file = fopen('../data/report_data.json', 'w');
  fwrite($data_file, $data);
  fclose($data_file);
}


/* ***
 * Sets up the site in the data array.
 */
function setupSite($site) {
  global $data;
  global $date;

  $site_name = $site['site_name'];
  error_log('Fetching issues for: ' . $site_name);

  // Add the site name if it's not already in there.
  if (!array_key_exists($site_name, $data)) {
    $data[$site_name] = array();
    $data[$site_name]['pages'] = $site['pages'];
    $data[$site_name]['reports'] = array();
  }

  // Set up array for current report.
  $data[$site_name]['reports'][$date] = array();

  return $site_name;
}


/* ***
 * Returns total number of pages for a particular site.
 */
function getTotalPages($data) {
  if (!array_key_exists('total_pages', $data)) {
    return 1;
  }

  return $data['total_pages'];
}


/* ***
 * Returns an initialized array of issues (by conformance level and severity)
 */
function initIssues() {
  return array(
    'a_error' => 0,
    'a_review' => 0,
    'a_warning' => 0,
    'aa_error' => 0,
    'aa_review' => 0,
    'aa_warning' => 0,
    'aaa_error' => 0,
    'aaa_review' => 0,
    'aaa_warning' => 0,
  );
}


/* ***
 * Returns itemized numbers of issues by conformance level and severity.
 */
function getIssues($item, $issues) {
  switch ($item['conformance_level']) {

    // A-level issues
    case 'a':
      switch ($item['severity']) {
        case 'error':
          $issues['a_error'] += $item['pages'];
          break;
        case 'review':
          $issues['a_review'] += $item['pages'];
          break;
        case 'warning':
          $issues['a_warning'] += $item['pages'];
          break;
      }
      break;

    // AA-level issues
    case 'aa':
      switch ($item['severity']) {
        case 'error':
          $issues['aa_error'] += $item['pages'];
          break;
        case 'review':
          $issues['aa_review'] += $item['pages'];
          break;
        case 'warning':
          $issues['aa_warning'] += $item['pages'];
          break;
      }
      break;

    // AAA-level issues
    case 'aaa':
      switch ($item['severity']) {
        case 'error':
          $issues['aaa_error'] += $item['pages'];
          break;
        case 'review':
          $issues['aaa_review'] += $item['pages'];
          break;
        case 'warning':
          $issues['aaa_warning'] += $item['pages'];
          break;
      }
      break;
  }

  return $issues;
}


/* ***
 * Save issue data to data array.
 */
function saveIssueData($site_name, $issues) {
  global $data;
  global $date;

  $data[$site_name]['reports'][$date]['a_error'] = $issues['a_error'];
  $data[$site_name]['reports'][$date]['a_review'] = $issues['a_review'];
  $data[$site_name]['reports'][$date]['a_warning'] = $issues['a_warning'];

  $data[$site_name]['reports'][$date]['aa_error'] = $issues['aa_error'];
  $data[$site_name]['reports'][$date]['aa_review'] = $issues['aa_review'];
  $data[$site_name]['reports'][$date]['aa_warning'] = $issues['aa_warning'];

  $data[$site_name]['reports'][$date]['aaa_error'] = $issues['aaa_error'];
  $data[$site_name]['reports'][$date]['aaa_review'] = $issues['aaa_review'];
  $data[$site_name]['reports'][$date]['aaa_warning'] = $issues['aaa_warning'];
}
