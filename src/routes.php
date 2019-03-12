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
  ],
  [
    'method' => 'POST',
    'path' => '/product/delete',
    'handler' => 'ProductDeleteController'
  ],
  [
    'method' => 'POST',
    'path' => '/product/update',
    'handler' => 'ProductUpdateController'
  ],
  [
    'method' => 'GET',
    'path' => '/product/item/{id}',
    'handler' => 'ProductReadController'
  ]
];
