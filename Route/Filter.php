<?php

  namespace Route;

  class Filter implements Attribute
  {
    protected $attributes = array();
    protected $expectations = array();

    protected $lastCheck;

    public function is(Attribute $attribute) {
      $this->attributes[] = $attribute;
      $this->expectations[] = TRUE;
      return $this;
    }

    public function not(Attribute $attribute) {
      $this->attributes[] = $attribute;
      $this->expectations[] = FALSE;
      return $this;
    }

    public function oneOf(Attribute $attribute) {
      $args = func_get_args();
      array_unshift($args, 1);
      return call_user_func_array(array($this, 'nOf'), $args);
    }

    public function nOf($n, Attribute $attribute) {
      $attributes = array_slice(func_get_args(), 1);
      $alternative = new Alternative;
      $alternative->min($n);

      foreach($attributes as $attribute) {
        $alternative->is($attribute);
      }
      return $this->is($alternative);
    }

    public function check() {
      if($this->lastCheck === NULL) {
        $this->lastCheck = TRUE;
        foreach($this->attributes as $key => $attribute) {
          if($attribute->check() !== $this->expectations[$key]) {
            $this->lastCheck = FALSE;
            break;
          }
        }
      }
      return $this->lastCheck;
    }

    public function reset() {
      $this->lastCheck = NULL;
      return $this;
    }
  }

?>