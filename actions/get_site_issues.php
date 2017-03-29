<?php

require_once 'api.php';
require_once 'functions.php';

global $api;

$data = readSavedData();
$site = $_GET['site'];
$site_data = $data[$site];

echo json_encode($site_data);
