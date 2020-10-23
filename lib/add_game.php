<?php

function add_game(
  String $name,
  String $creator,
  String $price,
  String $publishser
) {
  global $bdd;
  try {
    $req = $bdd->prepare("INSERT INTO game(name, creator, publisher, price) VALUES (?, ?, ?, ?)");

    $req->execute([$name, $creator, $publisher,$price]);
    return NULL;
  } catch (Exception $err) {
    return $err;
  }
}
?>
