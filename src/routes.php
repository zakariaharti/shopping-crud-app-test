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
    'path' => '/product/create',
    'handler' => 'ProductCreateController'
  ],
  [
    'method' => 'GET',
    'path' => '/product/list',
    'handler' => 'ProductListController'
  ]
];
