<?php

function add_game(
  String $name,
  String $creator,
  String $price,
  String $publishser,
  bool $has_image
) {
  global $bdd;
  try {
    $req = $bdd->prepare("INSERT INTO game(name, creator, publisher, price, image) VALUES (?, ?, ?, ?, ?)");

    $req->execute([$name, $creator, $publisher, $price, $has_image ? 1 : 0]);
    return NULL;
  } catch (Exception $err) {
    return $err;
  }
}
?>
