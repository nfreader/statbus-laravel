<?php

namespace Statbus;

class Statbus {

  public function generateToken(bool $secure=TRUE){
    $r_bytes = openssl_random_pseudo_bytes(5120, $secure);
    return hash('sha512', $r_bytes);
  }

}