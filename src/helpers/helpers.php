<?php

use \Firebase\JWT\JWT;

function input($param, $default = '')
{
  return isset($_POST[$param]) ? $_POST[$param] : $default;
}

function isEmptyValues($arrs, $length = 1)
{
  if (!empty($vars)) {
    foreach ($vars as $key => $value) {
      if (!strlen($value)) {
        throw new \Exception("missing value in ${key}");
      }
    }
    return false;
  }
}

function hashPassword($pass)
{
  return password_hash($pass, PASSWORD_DEFAULT);
}

function getJwtToken(array $data)
{
  // variables used for jwt
  $key = "secret_key";
  $iss = "http://example.org";
  $aud = "http://example.com";
  $iat = 1356999524;
  $nbf = 1357000000;

  $token = array(
    "iss" => $iss,
    "aud" => $aud,
    "iat" => $iat,
    "nbf" => $nbf,
    "data" => $data
  );

  // set response code
  http_response_code(200);

  // generate jwt
  return JWT::encode($token, $key);
}

function isAuthenticated($jwt){
  return JWT::decode($jwt, 'secret_key', array('HS256'));
}
