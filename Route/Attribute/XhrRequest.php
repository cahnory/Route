<?php

  namespace Route\Attribute;
  use Route\Attribute;

  class XhrRequest implements Attribute
  {
    public function check() {
      return
        array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER)
        && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }
  }

?>