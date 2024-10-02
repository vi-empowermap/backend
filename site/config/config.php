<?php
// 2.Handling Preflight Requests in PHP
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Origin: https://padlas.de");
    header("Access-Control-Allow-Origin: http://localhost:3000");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Credentials: true");
    http_response_code(200);
    exit(0);
}
// 4.Setting Headers
// Existing PHP logic
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Origin: https://padlas.de");
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

// Kirby::plugin('yourname/cors', [
//     'hooks' => [
//         'file.render:before' => function ($file, $options) {
//             if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
//                 header('Access-Control-Allow-Origin: *');
//             }
//         }
//     ]
// ]);
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
   
    'hooks' => [
        'user.create:before' => function ($user, $input) {
            $kirby = kirby();
            $currentUser = $kirby->user();
            
            // Check if the current user is SubSystemAdmin
            if ($currentUser->role()->name() === 'subsystemadmin') {
                $allowedRoles = ['orga']; // Replace 'role1', 'role2' with the specific roles

               
                if (!in_array($input['role'], $allowedRoles)) {
                    throw new Exception('You are not allowed to create this user role Sub-System-Admin can create only Orga User');
                }
            }
        },
        // 'blueprint' => function ($blueprint, $name) {
        //     $kirby = kirby();
        //     $user = $kirby->user();

        //     // Only modify the 'site' blueprint
        //     if ($name === 'site' && $user) {
        //         if ($user->role()->name() === 'subsystemadmin') {
        //             // Remove the restrictedField for subsystemadmin
        //             unset($blueprint['fields']['randomcode']);
        //         } elseif ($user->role()->name() === 'admin') {
        //             // Remove the subsystemAdminField for admin
        //             unset($blueprint['fields']['subsystemAdminField']);
        //         }
        //     }

        //     return $blueprint;
        // }

    ],
    
    // 'panel' => [
    //     'install' => function () {
    //         $user = kirby()->user();
    //         if ($user && $user->role()->name() === 'subsystemadmin') {
    //             echo '<link rel="stylesheet" href="' . url('assets/css/custom-panel.css') . '">';
    //         }
    //     }
    // ],
    
];
