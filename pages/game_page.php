<?php
$PAGE_NAME = "Game Page";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/game_page.css\" />";
include_once("../lib/head.php");

if (isset($_GET["name"])) {
  $game_res = find_game_by_name($_GET["name"]);
} else if (isset($_GET["id"])) {
  $game_res = find_game_by_id($_GET["id"]);
} else {
  $game_res = false;
}

if (!$game_res) {
  $game_res = new Game(0, "[phantom]", 0.5, 0, false);
}

//On va faire une boucle avec toutes les critiques du jeu
//On a d'abord besoin du nombre de critiques
$count_req = $bdd->prepare("SELECT COUNT(*) AS counter FROM review WHERE id_game = ?");
if ($count_req->execute([$game_res->id])){
  $count_res = $count_req->fetch();
}

//On vas chercher les critiques
$review_req = $bdd->prepare("SELECT * FROM review WHERE id_game = ?");
if($review_req->execute([$game_res->id])){
  $access_to_critic=true;
  $review_res = $review_req->fetch();
}

// NOTE: can't this be done using a while loop?

//On met les critiques dans nos objets
for($i = 0; $i < $count_res['counter']; $i++){
  if($access_to_critic){//Si tout s'est bien passé durant la requête

    //On cherche le nom de l'utilisateur qui a posté chaque critique
    $user_req = $bdd->prepare("SELECT * FROM user WHERE id=?");

    if($user_req->execute([$review_res['id_user']])) {
      $user_res = $user_req->fetch();//On enregistre m'utilisateur pour le réusitliser just après


      $search_res[$i] = new Critic(
        new Player($user_res['id'], $user_res['pseudonym'], time(), $user_res['country'], $user_res['password'], $user_res['profile_picture']),
        $review_res['comment'],
        $review_res['date_publication'],
        -63,
        $review_res['score']
      );
      $review_res = $review_req->fetch();
    }
  }
}

?>

<section class="game-page card-list">
  <h2><?php echo $game_res->title; ?></h2>
   <!---article is only dedicated to the game--->
  <article class="game">

    <div class="global-informations">
      <!---Size for the image : 64px--->
      <img src="/Test_Image/7_wonders_board_game_cover.png" alt="Seven wonders board game" />
      <h4 class="mark">Note: <?php echo round($game_res->note, 1); ?>/10</h4>
    </div>

    <aside>
      <div class="price">Price: <b><?php if ($game_res->price === NULL) echo "?"; else echo $game_res->price; ?>&nbsp;€</b></div>
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
  if ($current_user) {
    echo "<div class=\"vertical-spacer\"></div>";
    echo "<a href=\"/game_edition.php?id=" . $game_res->id . "\" class=\"center gray\">Edit game</a>";
  }

  foreach ($search_res as $critic) {
    ?>
    <aside class="player-critic">
      <div class="post-infos">
        <?php if ($critic->author->has_profile_picture) { ?>
          <a href="/images/user/<?php echo $critic->author->id; ?>.png">
            <img src="/images/user/<?php echo $critic->author->id; ?>.png" alt="PP" />
          </a>
        <?php } else { ?>
          <a href="/images/user-default.png">
            <img src="/images/user-default.png" alt="PP" />
          </a>
        <?php } ?>
        <a class="username" href="/user.php?id=<?php echo $critic->author->id; ?>">
          <?php echo $critic->author->username; ?>
        </a>
        <div class="publication-date">Published the <?php echo date("Y-m-d", strtotime($critic->date)); ?></div>
      </div>

      <p><?php echo $critic->contents; ?></p>

    <div><?php echo $critic->score; ?>/10</div>

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
