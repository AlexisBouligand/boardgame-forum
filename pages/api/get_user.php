<?php
include_once("../../lib/prelude.php");

if (isset($_GET["id"])) {
  $user = find_player_by_id($_GET["id"]);
} else if (isset($_GET["name"])) {
  $user = find_player_by_name($_GET["name"]);
} else {
  echo json_encode(array(
    "result" => NULL,
    "error" => "No ID given!"
  ));
  die();
}

if ($user === false) $user = NULL;

echo json_encode(array(
  "result" => $user,
));
?>
