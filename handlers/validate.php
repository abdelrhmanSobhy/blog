<?php


$validates = [
    "name" => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            'regexp' => '/^[A-Za-z\s]+$/'
        ],
        'error' => 'Name must contain only letters and spaces.'
    ],
    "email" => [
        'filter' => FILTER_VALIDATE_EMAIL,
        'error' => 'Please enter a valid email.'
    ],
    "password" => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            'regexp' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ],
        'error' => 'Password must be at least 8 characters with upper, lower, number, and symbol.'
    ],
    "phone" => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            'regexp' => '/^\+?[1-9]\d{1,14}$/'
        ],
        'error' => 'Please enter a valid phone number.'
    ]
];