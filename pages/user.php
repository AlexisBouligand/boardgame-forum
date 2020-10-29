<?php
$PAGE_NAME = "Utilisateur";
// $PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/user_page.css\" />";
include_once("../lib/head.php");


if (isset($_GET["username"])) {
  //Maintenant qu'on a le pseudo on aimerais l'objet user donc on va faire une requête pour récupérer les différents éléments

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
  $user->draw_card();
  ?>
</section>
<?php
include_once("../lib/tail.php");
?>
