<?php

return [
    'custom' => [
        'email' => [
            'required' => 'We need to know your e-mail address!',
            'email' => 'Invalid email',
            'unique' => 'Email must be unique!'
        ],
        'city' => [
            'required' => "City is strongly required!",
            'numeric' => "City must be an ID number"
        ],
        'password' => [
            'required' => 'Wow, please set password!',
            'confirmed' => 'Both passwords must match',
            'min' => "Password should have at least :min chars"
        ]
    ]
];
