<?php
$PAGE_NAME = "Game Page";
$PAGE_HEAD = "<script src=\"/js/game_page.js\" defer></script><link rel=\"stylesheet\" href=\"/css/game_page.css\" />";
include_once("../lib/head.php");
include_once("../lib/add_review.php");

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

//We'll make a loop to get all the critics
//We first need to het the number of critics
$count_req = $bdd->prepare("SELECT COUNT(*) AS counter FROM review WHERE id_game = ?");
if ($count_req->execute([$game_res->id])) {
    $count_res = $count_req->fetch();
}

//We get the critics
$review_req = $bdd->prepare("SELECT review.id,review.score,review.comment,review.id_user,review.id_game,review.date_publication FROM review LEFT JOIN vote ON review.id=vote.id_review WHERE review.id_game=? GROUP BY review.id ORDER BY AVG(vote.positive) DESC;");
if($review_req->execute([$game_res->id])) {
    $access_to_critic=true;
    $review_res = $review_req->fetch();
}


$search_res = NULL;
//We put the critics inside a Critic object
for($i = 0; $i < $count_res["counter"]; $i++) {
    if($access_to_critic) { //If everything went went during the query

        //We search for the username of the user who write the critic
        $user_req = $bdd->prepare("SELECT * FROM user WHERE id=?");

        if($user_req->execute([$review_res["id_user"]])) {
            $user_res = $user_req->fetch(); //We save the user to use him/her then

            //Get the karma of the current review
            $karma_req = $bdd->prepare("SELECT SUM(positive) FROM vote WHERE id_review = ?;");
            if ($karma_req->execute([$review_res["id"]])) {
                $karma_res = $karma_req->fetch();
                if ($karma_res[0] == NULL) {
                    $karma_res[0] = 0;
                }
            }

            $current_vote = 0;
            if ($current_user) {
                $current_vote_req = $bdd->prepare("SELECT * FROM vote WHERE id_user = ? AND id_review = ?;");
                if (
                    $current_vote_req->execute([$current_user->id, $review_res["id"]])
                    && ($current_vote_res = $current_vote_req->fetch())
                ) {
                    $current_vote = $current_vote_res["positive"];
                }
            }


            $search_res[$i] = new Critic(
                $review_res["id"],
                new Player($user_res["id"], $user_res["pseudonym"], time(), $user_res["country"], $user_res["password"], $user_res["profile_picture"]),
                $review_res["comment"],
                $review_res["date_publication"],
                $karma_res[0],
                $review_res["score"],
                $current_vote
            );
            $review_res = $review_req->fetch();
        }
    }
}

//If there is no comments published for this game, we display this comment
if ($search_res == NULL) {
    $search_res = [new Critic(
        0,
        new Player(0, "[phantom]", 0, "FR", "..."),
        "There seems to be no comment here, be the first to give your opinion!",
        "01/01/0001",
        0,
        0)];
}

//Ask for a game and a user
function try_create_review($game_res, $current_user) {

    if ($current_user == NULL) {
        return "You need to be connected to submit a review";
    }

    // TODO: validate and sanitize ?
    $score = $_POST["score"];
    $comment = $_POST["comment"];
    $id_game = $game_res->id;
    $id_user = $current_user->id;

    if (!is_numeric($score) || $score < 0 || $score > 10 || $score != round($score)) return "Invalid parameter: score";

    $res = add_review(
        $score,
        $comment,
        $id_game,
        $id_user
    );
    if ($res == NULL) {
        header("Refresh: 0");
    } else {
        return "There was an error while trying to add your review: " . $res;
    }
}

if (isset($_POST["submit"])) {
    echo try_create_review($game_res, $current_user);
}
?>


<!-- Display of the game-->
<section class="game-page card-list">
  <h2><?php echo $game_res->title; ?></h2>
   <!---article is only dedicated to the game--->
  <article class="game">

    <div class="global-informations">
      <!---Size for the image : 64px--->
      <img src="<?php if ($game_res->has_image) echo "/images/game/" . $game_res->id . ".png"; else echo "/images/game-default.png"; ?>" alt="Game's picture" />
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
  //If the user is connected, he can see the button "Edit game" and the button "Write Review"
  if ($current_user) {
      echo "<div class=\"game-edition-buttons\">";
      echo "<button class=\"open-button\" onclick=\"toggle_form()\">Write Review</button>";
      echo "<a href=\"/game_edition.php?id=" . $game_res->id . "\" class=\"center gray\">Edit game</a>";
      echo "</div>";
  } ?>

  <!-- Write Review Form -->

  <div class="form-popup" id="form-popup">
      <form method="post" action="game_page.php?id=<?php echo $game_res->id; ?>" class="form-container">
          <h2>Write review</h2>

          <label>
              <b>Score : </b>
              <input type="number" placeholder="Score" name="score" min="0" max="10" required>
          </label>
          <label for="comment"><b>Comment:</b></label>
          <input type="text" placeholder="Enter your comment (not required)" name="comment">
          <button type="submit" name="submit" class="btn">Send</button>
          <a class="btn cancel" onclick="close_form()">Cancel</a>
      </form>
  </div>

  <?php
    //Display the critics while they aren't all displayed
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

            <h3><?php echo $critic->contents; ?></h3>

            <div><?php echo $critic->score; ?>/10</div>

            <div class="karma-box">
                <a
                  name="like"
                  <?php if ($critic->current_vote == 1) {
                    echo "class=\"like active\"";
                  } else {
                    echo "class=\"like\"";
                  } ?>
                  <?php if ($current_user) { ?>
                    onclick="vote(<?php echo $critic->id; ?>, 1, this);"
                  <?php } ?>
                >
                    <span>&#x25b2;</span>
                </a>
                <span class="karma"><?php echo $critic->karma; ?></span>
                <a
                  name="dislike"
                  <?php if ($critic->current_vote == -1) {
                    echo "class=\"dislike active\"";
                  } else {
                    echo "class=\"dislike\"";
                  } ?>
                  <?php if ($current_user) { ?>
                    onclick="vote(<?php echo $critic->id; ?>, -1, this);"
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
