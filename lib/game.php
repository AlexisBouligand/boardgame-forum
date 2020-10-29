<?php

class Game {
  public $id = 0;
  public $title = null;
  public $note = 0.5; // from 0 to 1
  public $price = 0;
  public $publisher = null;
  public $has_image = false;

  public function __construct(
    $id = 0,
    $title = null,
    $note = 0.5,
    $price = 0,
    $publisher = null,
    $has_image = false
  ) {
    $this->id = $id;
    $this->title = $title;
    $this->note = $note;
    $this->price = $price;
    $this->publisher = $publisher;
    $this->has_image = $has_image;
  }
}

function find_game_by($trait, $value) {
  global $bdd;
  // Fetch most of the information
  $req = $bdd->prepare("SELECT id, name, creator, publisher, price, image FROM game WHERE $trait = ?;");

  if ($req->execute([$value]) && ($res = $req->fetch())) {
    // Fetch the average score of the game
    $note_req=$bdd->prepare("SELECT AVG(score) AS mean FROM review WHERE id_game = ?;");

    if($note_req->execute([$res["id"]])){
      $note = $note_req->fetch()["mean"];
    } else {
      $note = 0;
    }

    return new Game($res["id"], $res["name"], $note, $res["price"], $res["publisher"], !!$res["image"]);
  } else {
    return false;
  }
}

function find_game_by_name($name) {
  return find_game_by("name", $name);
}

function find_game_by_id($id) {
  return find_game_by("id", $id);
}

?>
