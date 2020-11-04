<?php
$PAGE_NAME = "Statistics Page";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/game_page.css\" />";
include_once("../lib/head.php");




?>

<!-- Users section -->
<section id="section_user">

    Number of registered users :
    <?php
    //Prepare a MySQL request
    $req = $bdd->prepare("SELECT COUNT(*) FROM user;");
    // We execute it
    $req->execute();
    echo $req->fetch()[0];
    ?>
    <br/>
    Average number of followed user by a user :
    <?php
    $nb_follow_req = $bdd->prepare("SELECT COUNT(*) fROM follows");
    $nb_follow_req->execute();
    $nb_follow_res = $nb_follow_req->fetch();

    $nb_user_req = $bdd->prepare("SELECT COUNT(*) FROM user");
    $nb_user_req->execute();
    $nb_user_res = $nb_user_req->fetch();

    $avg = $nb_follow_res[0]/$nb_user_res[0];
    echo $avg;
    ?>
    <br/>
    Average number of review written by a user :
    <?php
    $nb_review_req = $bdd->prepare("SELECT COUNT(*) fROM review");
    $nb_review_req->execute();
    $nb_review_res = $nb_review_req->fetch();

    $nb_user_req = $bdd->prepare("SELECT COUNT(*) FROM user");
    $nb_user_req->execute();
    $nb_user_res = $nb_user_req->fetch();

    $avg = $nb_review_res[0]/$nb_user_res[0];
    echo $avg;
    ?>


</section>

<br/>

<!-- Games section -->
<section id="section_game">

    Number of registered games :
    <?php
    //Prepare a MySQL request
    $req = $bdd->prepare("SELECT COUNT(*) FROM game;");
    // We execute it
    $req->execute();
    echo $req->fetch()[0];
    ?>
    <br/>
    Average number of review on a game :
    <?php
    $nb_review_req = $bdd->prepare("SELECT COUNT(*) fROM review");
    $nb_review_req->execute();
    $nb_review_res = $nb_review_req->fetch();

    $nb_game_req = $bdd->prepare("SELECT COUNT(*) FROM game");
    $nb_game_req->execute();
    $nb_game_res = $nb_game_req->fetch();

    $avg = $nb_review_res[0]/$nb_game_res[0];
    echo $avg;
    ?>
    <br/>
    Average game score :
    <?php
    $req = $bdd->prepare("SELECT AVG(a.rcount) FROM (select AVG(score) as rcount FROM review r GROUP BY r.id_game) a");
    $req->execute();
    echo $req->fetch()[0];
    ?>

</section>


<?php
include_once("../lib/tail.php");
?>
