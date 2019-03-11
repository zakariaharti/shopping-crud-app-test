<?php

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
