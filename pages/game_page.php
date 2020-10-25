<?php
$PAGE_NAME = "Game Page";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/game_page.css\" />";
include_once("../lib/head.php");

$game_res = new Game(1, "7 Wonders", 0.75, 18.76, "Repos Productions");
$search_res = [
  new Critic(
    new Player(0, "Jean-Paul", time(), "WK", "password"),
    "Muni d’un seul mot – The Game – et décidé à se battre pour sauver le monde, notre protagoniste sillonne l’univers crépusculaire du game. Sa mission le projettera dans une dimension qui dépasse le temps. Pourtant, il ne s’agit pas d’un voyage dans le temps, mais bel et bien d'un voyage à travers les époques…",
    time(),
    12
  ),
  new Critic(
    new Player(1, "UwU", time(), "FR", "password"),
    "C T kool",
    time(),
    -63
  )
];
?>
<section class="game-page card-list">
  <h2><?php echo $game_res->title; ?></h2>
   <!---article is only dedicated to the game--->
  <article class="game">

    <div class="global-informations">
      <!---Size for the image : 64px--->
      <img src="/Test_Image/7_wonders_board_game_cover.png" alt="Seven wonders board game" />
      <div class="game-title"><?php echo $game_res->title; ?></div>
      <h4 class="mark">Note: <?php echo round($game_res->note * 10);?>/10</h4>
    </div>

    <aside>
      <div class="price">Price: <b><?php echo $game_res->price; ?>€</b></div>
      <?php
      if ($game_res->publisher != null) {
         ?>
         <div class="publisher">Publisher: <b><?php echo $game_res->publisher; ?></b></div>
         <?php
      }
      ?>
    </aside>
  </article>

  <?php
  foreach ($search_res as $critic) {
    ?>
    <aside class="player-critic">
      <div class="post-infos">
        <img src="/Test_Image/Profile_Picture.png" alt="PP">
        <div class="username"><?php echo $critic->author->username; ?></div>
        <div class="publication-date">Published the <?php echo date("Y-m-d", $critic->date); ?></div>
      </div>

      <p><?php echo $critic->contents; ?></p>

      <div class="karma-box">
        <a class="like" name="like" href="#">
          <span>&#x25b2;</span>
        </a>
        <span class="karma"><?php echo $critic->karma; ?></span>
        <a class="dislike" name="dislike" href="#">
          <span>&#x25bc;</span>
        </a>
      </div >

    </aside>
    <?php
  }
  ?>

</section>

<?php
include_once("../lib/tail.php");
?>
