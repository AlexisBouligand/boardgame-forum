<?php


$name = $_POST["name"];
$creator = $_POST["creator"];
$price=$_POST["price"];
$publisher=$_POST["publisher"];



$req = $bdd->prepare("INSERT INTO game(name,creator,publisher,price)  VALUES (?,?,?,?)");

$req->execute([$name, $creator, $publisher,$price]);

header("Location:../html/index.php")//Rediriger l'user


?>
