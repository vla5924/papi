<?php

require_once __DIR__ . '/../autoloader.php';
require_once __DIR__ . '/SimpleMethod.php';

$api = new PAPI\Entrypoint('SimpleAPI');

// You can pass parameters from POST query
$api->run($_POST);

// Or use any other array
// $api->run(['key1' => 'value1', 'key2' => 'value2']);
