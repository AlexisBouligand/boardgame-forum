<?php
$PAGE_NAME = "Accueil";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/main_page.css\" />";
include_once("../lib/head.php");

$search_res = [
  //new Game(1, "7 Wonders", 0.75, 18.76, "Repos Productions")
];
// Creates a SELECT query
$req = $bdd->prepare("SELECT game.id,game.name,AVG(score),price,publisher FROM game INNER JOIN review ON game.id = review.id_game GROUP BY game.id ORDER BY AVG(score) DESC;");
// Execute the query
$req->execute();
// While there is something to read and less than 10 games are read
$nb_game_displayed = 0;
while($ligne = $req->fetch()) { // On est pas en lo21 donc on a le droit >.>
    //echo "<option value=\"$ligne[id]\">$ligne[country_name]</option>";
    $search_res[] = new Game($ligne[0], $ligne[1], $ligne[2], $ligne[3], $ligne[4]);
    if ($nb_game_displayed > 10){
        break;
    }
    $nb_game_displayed ++;
}
?>
<h2>Board games forum!</h2>

<section class="game-list">
  <?php
  foreach ($search_res as $game) {
    ?>
    <a class="game" href="game_page.php?id=<?php echo $game->id; ?>">
      <!-- <img class="game-picture" src="../lib/get_game_image.php?id=<?php echo $game->id; ?>" /> -->
      <h3 class="game-title"><?php echo $game->title;?></h3>
        <h3 class="game-title">Note:<?php echo $game->note;?></h3>
    </a>
    <?php
  }
  ?>
</section>

<?php
include_once("../lib/tail.php");
?>
