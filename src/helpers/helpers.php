<?php

function input($param, $default = '')
{
  isset($_POST[$param]) ? $_POST[$param] : $default;
}
