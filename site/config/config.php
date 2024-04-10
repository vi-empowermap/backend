<?php

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
    'debug' => true,
    'api' => [
        'basicAuth' => true,
        'allowInsecure' => true, //for http
    ],
    'panel' =>[
        'install' => true
    ],
    'kql' => [
        
    ],
    
    
];
