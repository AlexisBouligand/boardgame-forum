<?php
$PAGE_NAME = "Accueil";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/main_page.css\" />";
include_once("../lib/head.php");

$search_res = [
  new Game(1, "7 Wonders", 0.75, 18.76, "Repos Productions")
];
?>
<h2>Board games forum!</h2>

<section class="game-list">
  <?php
  foreach ($search_res as $game) {
    ?>
    <a class="game" href="game_page.php?id=<?php echo $game->id; ?>">
      <img class="game-picture" src="/Test_Image/7_wonders_board_game_cover.png" />
      <h3 class="game-title"><?php echo $game->title;?></h3>
    </a>
    <?php
  }
  ?>
</section>

<?php
include_once("../lib/tail.php");
?>
