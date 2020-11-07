<?php
$PAGE_NAME = "Utilisateur";
// $PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/user_page.css\" />";
$PAGE_HEAD = "<script src=\"/js/game_page.js\" defer></script><link rel=\"stylesheet\" href=\"/css/game_page.css\" />";
include_once("../lib/head.php");


if (isset($_GET["username"])) {
    //We get the user informations
    $user = find_player_by_name($_GET["username"]);
} else if (isset($_GET["id"])) {
    $user = find_player_by_id($_GET["id"]);
} else {
    $user = false;
}

if (!$user) $user = new Player(0, "[phantom]", 0, "FR", "...");
?>
<section class="card-list">
  <?php
  //We display the informations
  $user->draw_card();


//Separation
?>
<h2>
    <?php
    //If it is the page of the current user, we use a pronoun
    if($current_user!=NULL){
    if (strcmp($current_user->id,$user->id)) {
        echo htmlspecialchars($user->username) . "'s";
    } else {
        echo "Your";
    }}
    ?> comments :
</h2>
<?php

//Request the review written by the user
$review_req = $bdd->prepare("SELECT * FROM review WHERE id_user=? ORDER BY date_publication DESC");
$review_req->execute([$user->id]);
$i = 0;
while($review = $review_req->fetch())
{
    //Get the game for wich the review is written
    $game_req = $bdd->prepare("SELECT * FROM game WHERE id=?");
    $game_req->execute([$review['id_game']]);
    $game = $game_req->fetch();

    //Get the karma of the current review
    $karma_req = $bdd->prepare("SELECT SUM(positive) FROM vote WHERE id_review = ?;");
    if ($karma_req->execute([$review["id"]])) {
        $karma_res = $karma_req->fetch();
        if ($karma_res[0] == NULL) {
            $karma_res[0] = 0;
        }
    }
    $karma = $karma_res[0];

    //Get the connected user current vote
    $current_vote = 0;
    if ($current_user) {
        $current_vote_req = $bdd->prepare("SELECT * FROM vote WHERE id_user = ? AND id_review = ?;");
        if (
            $current_vote_req->execute([$current_user->id, $review["id"]])
            && ($current_vote_res = $current_vote_req->fetch())
        ) {
            $current_vote = $current_vote_res["positive"];
        }
    }

    ?>
    <aside class="player-critic">
        <div class="post-infos">
            <?php if ($game["image"]==1) { ?>
                <a href="/images/game/<?php echo $game["id"]; ?>.png">
                    <img src="/images/game/<?php echo $game["id"]; ?>.png" alt="game picture" />
                </a>
            <?php } else { ?>
                <a href="/images/game-default.png">
                    <img src="/images/game-default.png" alt="game picture" />
                </a>
            <?php } ?>
            <a class="username" href="/game_page.php?id=<?php echo $game["id"]; ?>">
                <?php echo htmlspecialchars($game["name"]); ?>
            </a>
            <div class="date-and-score">
                <div class="publication-date">Published the <?php echo date("Y-m-d", strtotime($review["date_publication"])); ?></div>
                <div class="score"><?php echo $review["score"]; ?>/10</div>
            </div>
        </div>

        <div class="comment"><?php echo htmlspecialchars($review["comment"]); ?></div>

        <div class="karma-box">
            <a
                name="like"
                <?php if ($current_vote == 1) {
                    echo "class=\"like active\"";
                } else {
                    echo "class=\"like\"";
                } ?>
                <?php if ($current_user) { ?>
                    onclick="vote(<?php echo $review["id"]; ?>, 1, this);"
                <?php } ?>
            >
                <span>&#x25b2;</span>
            </a>
            <span class="karma"><?php echo $karma; ?></span>
            <a
                name="dislike"
                <?php if ($current_vote == -1) {
                    echo "class=\"dislike active\"";
                } else {
                    echo "class=\"dislike\"";
                } ?>
                <?php if ($current_user) { ?>
                    onclick="vote(<?php echo $review["id"]; ?>, -1, this);"
                <?php } ?>
            >
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
