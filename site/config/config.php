<?php

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    http_response_code(200);
    exit(0);
}

// Existing PHP logic
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen. 
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */
return [
    
    'sylvainjule.backups.prefix' => 'backup-',
    'sylvainjule.backups.publicFolder' => 'my-secretly-public-backups',
    'sylvainjule.backups.maximum' => 2,
    'debug' => false,
    'api' => [
        'basicAuth' => true,
        'allowInsecure' => true, //for http
    ],
    'panel' =>[
        'install' => true
    ],
    'kql' => [
        'auth' => true
    ],
    
    
];
