<?php

function add_review(
    $id_user,
    $id_review,
    $positive //1 or -1
) {

    global $bdd;
    try {
        $req = $bdd->prepare("SELECT * FROM vote WHERE id_user = ? AND id_review = ?");

        $res = NULL;
        if ($req->execute([$id_user, $id_review])){
            $res = $req->execute([$id_user, $id_review]);
        }

        if ($res == NULL){
            $req = $bdd->prepare("INSERT INTO vote(id_user, id_review, positive) VALUES (?, ?, ?)");
            $req->execute([$id_user, $id_review, $positive]);
        }
        elseif ($res['positive'] != $positive){
            $req = $bdd->prepare("UPDATE vote SET positive = ? WHERE id_user = ? AND id_review = ?");
            $req->execute([$positive, $id_user, $id_review]);
        }
        else{
            $req = $bdd->prepare("DELETE FROM vote WHERE id_user = ? AND id_review = ?");
            $req->execute([$id_user, $id_review]);
        }


        return NULL;
    } catch (Exception $err) {
        return $err;
    }

}

?>