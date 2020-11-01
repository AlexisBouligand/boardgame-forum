<?php
$PAGE_NAME = "Utilisateur";
// $PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/user_page.css\" />";
include_once("../lib/head.php");


if (isset($_GET["username"])) {

    //We get the user informations
  $user = find_player_by_name($_GET["username"]);
} else if (isset($_GET["id"])) {
  $user = find_player_by_id($_GET["id"]);
} else {
  $user = false;
}

if (!$user) $user = new Player(0, "[phantom]", 0, "FR", "...");
?>
<section class="card-list">
  <?php
  //We display the informations
  $user->draw_card();
  ?>
</section>
<?php
include_once("../lib/tail.php");
?>
