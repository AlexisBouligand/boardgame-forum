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
    $this->birth_date = $birth_date;
    $this->username = $username;
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

    //Dans la bdd n'est stocké que l'id du pays pour l'utilisateur mais on veut ici donner le nom du pays donc on vas faire une autre requète
    $country_req=$bdd->prepare("SELECT country_name FROM country WHERE id=?");
    if($country_req->execute([ $res["country"] ]))
    {
      $country_res=$country_req->fetch();
    }

    if(password_verify($password, $res["password"])) {
      $current_user = new Player($res["id"], $pseudonym, $res["birthdate"], $country_res["country_name"], $password);
      // echo $current_user->country;
      return true;
    }
  }

  return false;
}



?>
