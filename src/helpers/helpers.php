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

function getJwtToken($data)
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
    "data" => array(
       "username" => $data['username'],
    )
  );

  // set response code
  http_response_code(200);

  // generate jwt
  return JWT::encode($token, $key);
}

function authenticate($data)
{
  $jwt = isset( $data["jwt"] ) ? $data["jwt"] : "";

  // if jwt is not empty
  if($jwt){

    // if decode succeed, show user details
    try {
        // decode jwt
        $decoded = JWT::decode($jwt, 'secret_key', array('HS256'));

        // set response code
        http_response_code(200);

        // show user details
        echo json_encode(array(
            "message" => "Access granted.",
            "data" => $decoded->data
        ));

    }catch (\Exception $e){
      // set response code
      http_response_code(401);

      // tell the user access denied  & show error message
      echo json_encode(array(
        "message" => "Access denied.",
        "error" => $e->getMessage()
      ));
    }

    // catch will be here
  } else{

    // set response code
    http_response_code(401);

    // tell the user access denied
    echo json_encode(array("message" => "Access denied."));
  }

// error if jwt is empty will be here
}
