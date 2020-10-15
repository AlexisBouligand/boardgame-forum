<?php

class Player {
  public $username = null;
  public $birth_date = 0;
  public $country = null;
  private $hashed_password = "";

  public function __construct($username = null, $birth_date = 0, $country = null, $hashed_password = "") {
    $this->username = $username;
    $this->birth_date = $birth_date;
    $this->country = $country;
    $this->hashed_password = $hashed_password;
  }
}

?>
