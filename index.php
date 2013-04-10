<?php

  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  require_once 'Route/Attribute.php';
  require_once 'Route/Attribute/RequestMethod.php';
  require_once 'Route/Attribute/XhrRequest.php';

  require_once 'Route/Filter.php';

  $f = new Route\Filter;
  $f->is(new Route\Attribute\RequestMethod('get'));

  if($f->check()) {
    echo 'match';
  }

?>