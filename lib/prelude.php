<?php

$games_page_length = 10;
$users_page_length = 20;

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
include_once("page_selector.php");

if (isset($_SESSION["pseudonym"]) && isset($_SESSION["password"])) {
  if (!try_login($_SESSION["pseudonym"], $_SESSION["password"])) {
    unset($_SESSION["pseudonym"]);
    unset($_SESSION["password"]);
  }
}

const PSEUDO_REGEX = "/^[a-zA-Z0-9_-]{3,20}$/";
const PASSWORD_REGEX = "/^.{8,}$/";

?>
