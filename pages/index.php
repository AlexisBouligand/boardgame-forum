<?php
$PAGE_NAME = "Accueil";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/main_page.css\" />";
include_once("../lib/head.php");

$search_res = [
  //new Game(1, "7 Wonders", 0.75, 18.76, "Repos Productions")
];
// Créer une requête SELECT pour récupérer les jeux
$req = $bdd->prepare("SELECT id,name FROM game;");
// Exécute la requête
$req->execute();
// Tant que il y a des données et que l'on enregistre moins de 10 jeux
$nb_game_displayed = 0;
while($ligne = $req->fetch()) { // On est pas en lo21 donc on a le droit >.>
    //echo "<option value=\"$ligne[id]\">$ligne[country_name]</option>";
    $search_res[] = new Game($ligne[0], $ligne[1], 0.75, 18.76, "Repos Productions");
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
      <img class="game-picture" src="../lib/get_game_image.php?id=<?php echo $game->id; ?>" />
      <h3 class="game-title"><?php echo $game->title;?></h3>
    </a>
    <?php
  }
  ?>
</section>

<?php
include_once("../lib/tail.php");
?>
