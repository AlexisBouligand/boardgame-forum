<?php

session_start();
include_once("../config.php");

// Connects to the database
$bdd = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", "$db_username", "$db_password");
unset($db_password);

$current_user = NULL;

include_once("player.php");
include_once("game.php");
include_once("critic.php");
include_once("upload.php");

if (isset($_SESSION["pseudonym"]) && isset($_SESSION["password"])) {
  if (!try_login($_SESSION["pseudonym"], $_SESSION["password"])) {
    unset($_SESSION["pseudonym"]);
    unset($_SESSION["password"]);
  }
}

?>
