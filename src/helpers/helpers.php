<?php

function input($param, $default = '')
{
  return isset($_POST[$param]) ? $_POST[$param] : $default;
}
