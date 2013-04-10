<?php

  namespace Route;

  class Alternative extends Filter
  {
    protected $min = 1;
    protected $max = 0;

    public function min($min) {
      $this->min = (int)$min;
    }

    public function max($max) {
      $this->max = (int)$max;
    }

    public function match() {
      if($this->lastCheck === NULL) {
        $found = 0;
        $this->lastCheck = true;

        foreach($this->attributes as $key => $attribute) {
          if($attribute->check() === $this->expectations[$key]) {
            $this->lastCheck++;

            // Min ok and no max
            if($this->lastCheck === $this->min && $this->max <= $this->min) {
              break;
            }

            // Max exceed
            if($this->lastCheck === $this->max + 1) {
              $this->lastCheck = false;
              break;
            }
          }
        }
      }
      return $this->lastCheck;
    }
  }

?>