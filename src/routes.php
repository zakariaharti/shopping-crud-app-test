<?php

return [
  [
    'method' => 'POST',
    'path' => '/login',
    'handler' => 'LoginController'
  ],
  [
    'method' => 'POST',
    'path' => '/signup',
    'handler' => 'SignupController'
  ],
  [
    'method' => 'POST',
    'path' => '/products/create',
    'handler' => 'ProductCreateController'
  ]
];
