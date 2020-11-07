<?php
include_once("../../lib/prelude.php");

$id_friend = NULL;
// On vas ajouter le poto dans la bdd
if (isset($_GET["id"])) {
    $id_friend = $_GET["id"];
}

if ($current_user != NULL && $id_friend != NULL) {
    $friend_req = $bdd->prepare("SELECT * FROM user WHERE id = ?");

    if ($friend_req->execute([$id_friend]) && ($friend = $friend_req->fetch())) {
        $follows_req = $bdd->prepare("SELECT * FROM follows WHERE id_user = ? AND id_friend = ?;");

        if ($follows_req->execute([$current_user->id, $id_friend])) {
            if ($follows = !$follows_req->fetch()) {
                $req = $bdd->prepare("INSERT INTO follows(id_user, id_friend) VALUES (?,?);");
            } else {
                $req = $bdd->prepare("DELETE FROM follows WHERE id_user = ? AND id_friend = ?;");
            }

            if ($req->execute([$current_user->id, $id_friend])) {
                echo json_encode(array(
                    "result" => "ok",
                    "current_user" => $current_user,
                    "id_friend" => $id_friend,
                    "follows" => $follows
                ));
            } else {
                echo json_encode(array(
                    "result" => "error",
                    "error" => $req->errorInfo(),
                    "current_user" => $current_user,
                    "id_friend" => $id_friend,
                    "follows" => $follows
                ));
            }
        } else {
            echo json_encode(array(
                "result" => "error",
                "error" => $follows_req->errorInfo(),
                "current_user" => $current_user,
                "id_friend" => $id_friend
            ));
        }
    } else {
        echo json_encode(array(
            "result" => "error",
            "error" => "Target user does not exist",
            "current_user" => $current_user,
            "id_friend" => $id_friend
        ));
    }
} else {
    if ($id_friend == NULL) {
        echo json_encode(array(
            "result" => "error",
            "error" => "No id given",
            "id_friend" => $id_friend
        ));
    } else {
        echo json_encode(array(
            "result" => "error",
            "error" => "Not logged in",
            "id_friend" => $id_friend
        ));
    }
}
?>
