<?php
include_once("../lib/head.php");
include_once ("../lib/player.php");

$id_friend=NULL;
//On vas ajouter le poto dans la bdd
if(isset($_GET["id"]))
{
    $id_friend=$_GET["id"];
}



$req=$bdd->prepare("INSERT INTO follows(id_user,id_friend) VALUES (?,?);");



if($current_user!=NULL)
{

    if($req->execute([$current_user->id, $id_friend]) && $id_friend!=NULL)
    {
        header("Location:../pages/follow_page.php");
    }

    echo "friend $id_friend";
    echo  "<br/> $current_user->id";
}



?>