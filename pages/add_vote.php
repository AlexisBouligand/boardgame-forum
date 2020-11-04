<?php

include_once("../lib/prelude.php");

//Get the parameters from the url
$id_review = $_GET["id_review"];
$positive = $_GET["positive"];

$req = $bdd->prepare("SELECT * FROM vote WHERE id_user = ? AND id_review = ?");

if ($current_user) {
    if (
        $id_review && is_numeric($id_review) && $id_review > 0 && $id_review == round($id_review, 0)
        && $positive && ($positive === "-1" || $positive === "1")
        && $req->execute([$current_user->id, (int)$id_review])
    ) {
        $vote = $req->fetch();
        if (!$vote || !isset($vote["id_user"])) {
            $req = $bdd->prepare("INSERT INTO vote(id_user, id_review, positive) VALUES (?, ?, ?)");
            $req->execute([$current_user->id, $id_review, $positive]);
        } else if ($vote["positive"] != $positive) {
            $req = $bdd->prepare("UPDATE vote SET positive = ? WHERE id_user = ? AND id_review = ?");
            $req->execute([$positive, $current_user->id, $id_review]);
        } else {
            $req = $bdd->prepare("DELETE FROM vote WHERE id_user = ? AND id_review = ?");
            $req->execute([$current_user->id, $id_review]);
        }

        $karma_req = $bdd->prepare("SELECT SUM(positive) FROM vote WHERE id_review = ?;");
        $karma = 0;
        if ($karma_req->execute([$id_review])) {
            $karma_res = $karma_req->fetch();
            if ($karma_res[0] != NULL) {
                $karma = (int)$karma_res[0];
            }
        }

        echo json_encode(array(
            "result" => "ok",
            "new_karma" => $karma,
            "vote_value" => !$vote || $vote["positive"] != $positive ? (int)$positive : 0,
            "current_user" => $current_user,
        ));
    } else {
        echo json_encode(array(
            "result" => "error",
            "error" => "Invalid parameter",
            "current_user" => $current_user
        ));
    }
} else {
    echo json_encode(array(
        "result" => "error",
        "error" => "Not logged in"
    ));
}
?>
