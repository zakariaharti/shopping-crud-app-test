<?php

return [
  [
    'method' => 'GET',
    'path' => '/login/{name}',
    'handler' => 'LoginController'
  ],
  [
    'method' => 'POST',
    'path' => '/signup',
    'handler' => 'SignupController'
  ]
];
