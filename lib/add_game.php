<?php

//Take the informations of a game as parameters
//Insert this information in the database
//Return an error or not
function add_game(
  String $name,
  String $creator,
  String $price,
  String $publisher,
  bool $profile_picture,
  Int $tag_id
) {
  global $bdd;

  try {
    //We insert into the game table
    $req = $bdd->prepare("INSERT INTO game(name, creator, publisher, price, image) VALUES (?, ?, ?, ?, ?)");

    $req->execute([$name, $creator, $publisher,$price, $profile_picture]);

    //We get the id of the game
    $game_id_req = $bdd->prepare("SELECT id FROM game WHERE name = ?");
    if($game_id_req->execute([$name]))
    {
      $game_id_res=$game_id_req->fetch();
    }


    header("Location:head.php");

    //We insert the game id and the tag id into the tag_relation table
    $tag_req=$bdd->prepare("INSERT INTO relation_tag VALUES (?,?)");
    $tag_req->execute([$game_id_res['id'],$tag_id]);

    return NULL;
  } catch (Exception $err) {
    return $err;
  }

}

?>
