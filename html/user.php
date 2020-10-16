<?php
$PAGE_NAME = "Utilisateur";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"../css/user_page.css\" />";
include_once("../lib/head.php");



if (isset($_GET["user"])) {
  // get user given the ID
} else {
  $user = new Player(0, "[phantom]", 0, "FR", "...");
}
?>

<section class="user-page card-list">
  <h2><?php echo $user->username; ?></h2>
  <article class="user">
    <div class="global-informations">
      <img src="../Test_Image/Profile_Picture.png" alt="PP" class="profile-picture" />
      <div class="username"><?php echo $user->username; ?></div>
    </div>
  </article>
</section>


<?php
include_once("../lib/tail.php");
?>
