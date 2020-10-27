<?php
$PAGE_NAME = "Utilisateur";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/user_page.css\" />";
include_once("../lib/head.php");


if (isset($_GET["username"])) {

  $username=$_GET["username"];


  //Maintenant qu'on a le pseudo on aimerais l'objet user donc on va faire une requête pour récupérer les différents éléments

    $req=$bdd->prepare("SELECT * FROM user WHERE pseudonym= ?");

    if($req->execute([$username])) {
        $user_table = $req->fetch();

        //On cherche le nom du pays
        $country_req=$bdd->prepare("SELECT country_name FROM country WHERE id=?");
        if($country_req->execute([ $user_table["country"] ]))
        {
            $country_res=$country_req->fetch();
        }

        $user = new Player($user_table['id'], $user_table['pseudonym'], $user_table['birthdate'], $country_res["country_name"], $user_table['password']);
    }

} else {
  $user = new Player(0, "[phantom]", 0, "FR", "...");
}
?>

<section class="user-page card-list">
  <h2><?php echo $user->username; ?></h2>
  <article class="user">
    <div class="global-informations">
      <img src="/Test_Image/Profile_Picture.png" alt="Profile Picture" class="profile-picture" />
        <p>Birthdate : <?php echo $user->birth_date; ?></p>
        <p>Country: <?php echo $user->country; ?></p>
    </div>
  </article>
</section>


<?php
include_once("../lib/tail.php");
?>
