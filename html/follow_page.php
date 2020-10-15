<?php
$PAGE_NAME = "Accueil";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"../css/follow_page.css\" />";
include_once("../lib/head.php");
?>

<form class="main-form search-player" method="get" action="" id="pseudo_search">
  <label for="pseudo">Search for a Friend : </label>
  <input type="text" name="pseudo" id="pseudo" size="40" maxlength="30" <?php
    if (isset($_GET["pseudo"])) {
      echo $_GET["pseudo"];
    }
  ?> />
</form>

<section class="profiles">

  <?php
  // TODO: the actual search
  $search_res = [new Player("Jean-Paul", time(), "WK", "nope")];
  foreach ($search_res as $player) {
    ?>
    <aside class="player-profile">
      <div class="picture-and-nickname">
          <img src="../Test_Image/Profile_Picture.png" alt="PP">
          <h2 class="nickname"><?php echo $player->username; ?></h2>
      </div>

      <div class="profile-info">
        <span>
          Né(e) le <?php echo date("Y-m-d", $player->birth_date); ?>
        </span>
        <span>
          Pays: <?php echo $player->country; ?>
        </span>
      </div>

      <a class="follow" href="#">
        <span>Follow</span>
      </a>

    </aside>
    <?php
  }
  ?>

</section>

<?php
  include_once("../lib/tail.php");
?>
