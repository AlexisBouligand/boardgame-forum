<?php


//Take the informations of a game as parameters
//Insert this information in the database
//Return an error or not
function add_game(
  String $name,
  String $creator,
  String $price,
  String $publisher
) {
  global $bdd;
  try {
    $req = $bdd->prepare("INSERT INTO game(name, creator, publisher, price, image) VALUES (?, ?, ?, ?, ?)");

    $req->execute([$name, $creator, $publisher,$price]);


    return NULL;
  } catch (Exception $err) {
    return $err;
  }

}

?>
