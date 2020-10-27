<?php

global $bdd;

//$id = $_GET['id'];
$id = 1;
// do some validation here to ensure id is safe

$req = $bdd->prepare("SELECT `image` FROM `game` WHERE `id` = :id");
// Exécute la requête
$req->execute(array(':id'=>$_GET['id']));
$data = $req->fetch();

if(empty($data)){
    header("HTTP/1.0 404 Not Found");
} else {
    header('Content-type: image/jpeg');
    echo $data['image'];
}
?>