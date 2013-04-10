<?php

  namespace Route\Attribute;
  use Route\Attribute;

  class RequestMethod implements Attribute
  {
    protected $methods;

    public function __construct($method) {
      $this->methods = func_get_args();
    }

    public function check() {
      foreach($this->methods as $m) {
        if($_SERVER['REQUEST_METHOD'] === strtoupper($m)) {
          return true;
        }
      }
      return false;
    }
  }

?>