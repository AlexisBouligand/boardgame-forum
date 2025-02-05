<?php

//Take the informations of a review as parameters
//Insert this information in the database
//Return an error or not
function add_review(
    Int $score,
    String $comment,
    Int $id_game,
    Int $id_user
) {
    global $bdd;
    try {
        $req = $bdd->prepare("INSERT INTO review(score, comment, id_user, id_game) VALUES (?, ?, ?, ?)");

        $req->execute([$score, $comment, $id_user, $id_game]);


        return NULL;
    } catch (Exception $err) {
        return $err;
    }

}

?>