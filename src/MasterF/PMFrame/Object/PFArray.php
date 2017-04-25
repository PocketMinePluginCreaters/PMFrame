<?php

namespace MasterF\PMFrame\Object;

class PFArray {

  public function __construct(array $data) {
    $this->data = $data;
  }

  public function each($func) {
    foreach($this->data as $data) {
      $func($data);
    }
  }

  public function get($key) {
    return $this->data[$key] ?? null;
  }

  public function set($key, $val) {
    $this->data[$key] = $val;
  }

  public function toArray() {
    return $this->data;
  }

  public function getSubdata($data) {
    return $this->subdata ?? null;
  }

  public function setSubdata($data) {
    $this->subdata = $data;
  }

}
