<?php
$PAGE_NAME = "Accueil";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/main_page.css\" />";
include_once("../lib/head.php");

$search_res = [];
// Creates a SELECT query
$req = $bdd->prepare("SELECT game.id, AVG(review.score) AS mean_score FROM game LEFT JOIN review ON game.id = review.id_game GROUP BY game.id ORDER BY mean_score DESC;");

// Execute the query
if (!$req->execute()) {
  echo "Couldn't fetch the list of games!";
}

// While there is something to read and less than 10 games are read, we display a new game
$nb_game_displayed = 0;
while(($ligne = $req->fetch()) && $nb_game_displayed++ < 10) { // On est pas en lo21 donc on a le droit >.>
  $search_res[] = find_game_by_id($ligne["id"]);
}
?>
<h2>Board games forum!</h2>

<section class="game-list">
  <?php
  foreach ($search_res as $game) {
    ?>
    <a class="game" href="game_page.php?id=<?php echo $game->id; ?>">
      <?php if ($game->has_image) { ?>
        <img class="game-picture" src="/images/game/<?php echo $game->id; ?>.png" />
      <?php } else { ?>
        <img class="game-picture" src="/images/game-default.png" />
      <?php } ?>
      <h3 class="game-title"><?php echo htmlspecialchars($game->title);?></h3>
      <div class="game-note">Note: <?php if ($game->note == NULL) echo "N/A"; else echo number_format($game->note, 1); ?></div>
    </a>
    <?php
  }
  ?>
</section>

<?php
include_once("../lib/tail.php");
?>
