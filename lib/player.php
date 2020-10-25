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

function try_login($pseudonym, $password) {
  global $current_user;
  global $bdd;
  $req = $bdd->prepare("SELECT id, birthdate, country, password FROM user WHERE user.pseudonym = ?;");
  if ($req->execute([$pseudonym])) {
    $res = $req->fetch();
    if (password_verify($password, $res["password"])) {
      $current_user = new Player($res["id"], $pseudonym, $res["birthdate"], $res["country"], $password);
      return true;
    }
  }
  echo $pseudonym . "<br />" . $password . "<br />";

  return false;
}

?>
