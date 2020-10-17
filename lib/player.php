<?php

class Player {
  public $id = 0;
  public $username = null;
  public $birth_date = 0;
  public $country = null;
  private $hashed_password = "";

  public function __construct(
    $id = 0,
    $username = null,
    $birth_date = 0,
    $country = null,
    $hashed_password = ""
  ) {
    $this->id = $id;
    $this->username = $username;
    $this->birth_date = $birth_date;
    $this->country = $country;
    $this->hashed_password = $hashed_password;
  }
}

?>
