<?php

return[
    'from' => [
        'name' => env('MAIL_FROM_NAME')
    ],
    'customer_success_manager' => [
        'support' => env('CUSTOMER_SUCCESS_MANAGER_EMAIL'),
    ],
    'contact' => [
        'info' => env('CONTACT_EMAIL')
    ],
    'mail_from' => [
        'email' => env('MAIL_FROM_ADDRESS')
    ]
];
