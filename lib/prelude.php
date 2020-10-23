<?php

include_once("../config.php");

// Connects to the database
$bdd = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", "$db_username", "$db_password");
unset($db_password);

include_once("player.php");
include_once("game.php");
include_once("critic.php");
?>
