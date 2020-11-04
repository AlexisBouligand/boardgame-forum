<?php
$PAGE_NAME = "Games list";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/list_games.css\" />";
include_once("../lib/head.php");
include_once("../lib/selection_tag_list.php");

const ORDER_GAMES_NAME = 0;
const ORDER_GAMES_PRICE = 1;
const ORDER_GAMES_SCORE = 2;
const ORDER_GAMES_PUBLISHED = 3;
const ORDER_GAMES_REVIEWS = 4;

$reversed = false;
$last_page = true;


//====The sort part(note, game name, tag, date, etc.) of the game search====
if (isset($_GET["s"])) {
  switch (strtolower($_GET["s"])) {
    case "!published":
      $reversed = true;
      // fallthrough
    case "published":
      $order_method = ORDER_GAMES_PUBLISHED;
      break;
    case "!score":
      $reversed = true;
      // fallthrough
    case "score":
      $order_method = ORDER_GAMES_SCORE;
      break;
    case "!price":
      $reversed = true;
      // fallthrough
    case "price":
      $order_method = ORDER_GAMES_PRICE;
      break;
    case "!reviews":
      $reversed = true;
      // fallthrough
    case "reviews":
      $order_method = ORDER_GAMES_REVIEWS;
      break;
    case "!name":
      $reversed = true;
      // fallthrough
    case "name":
    default:
      $order_method = ORDER_GAMES_NAME;
  }
} else {
  $order_method = ORDER_GAMES_NAME;
}

if (isset($_GET["p"]) && is_numeric($_GET["p"]) && $_GET["p"] > 0 && $_GET["p"] == round($_GET["p"], 0)) {
  $page = (int)$_GET["p"] - 1;
} else {
  $page = 0;
}

$search_sql = "";

$search_terms = [];

//Need the name of the parameter to check in a query and a query
//Add an extension to the final request sent
//No return
function append_search_sql(String $query, String $key, String $value) {
  global $search_sql;
  global $search_terms;
  if ($search_sql == "") {
    $search_sql = "WHERE $query";
  } else {
    $search_sql .= "AND $query";
  }
  $search_terms[$key] = $value;
}


// If there is the name of a game in the search, we search it
if (isset($_GET["name"])) {
  append_search_sql(
      "game.name LIKE CONCAT('%', :name, '%')",
      "name",
      $_GET["name"]
  );
}

$tag_sql = "";
$tag = "none";

// If there is a tag defined, we search it
if(isset($_GET["tag"])) {
    if ($_GET["tag"] && $_GET["tag"] != 'none' && is_numeric($_GET["tag"]) && $_GET["tag"] > 0 && $_GET["tag"] == round($_GET["tag"], 0)) {
        $tag = (int)$_GET["tag"];
        $tag_sql = "INNER JOIN relation_tag ON relation_tag.id_game = game.id && relation_tag.id_tag = :tag";
        $search_terms["tag"] = $_GET['tag'];
    }
}

$offset_sql = "LIMIT " . ($page * $games_page_length) . ", " . $games_page_length;
switch ($order_method) {
  case ORDER_GAMES_NAME:
    $sort_sql = "ORDER BY game.name";
    if ($reversed) $sort_sql .= " DESC";
    else $sort_sql .= " ASC";
    break;
  case ORDER_GAMES_PRICE:
    $sort_sql = "ORDER BY game.price";
    if ($reversed) $sort_sql .= " DESC";
    else $sort_sql .= " ASC";
    break;
  case ORDER_GAMES_PUBLISHED:
    $sort_sql = "ORDER BY game.id";
    if ($reversed) $sort_sql .= " ASC";
    else $sort_sql .= " DESC";
    break;
  case ORDER_GAMES_SCORE:
    $sort_sql = "ORDER BY mean_score";
    if ($reversed) $sort_sql .= " ASC";
    else $sort_sql .= " DESC";
    break;
  case ORDER_GAMES_REVIEWS:
    $sort_sql = "ORDER BY review_count";
    if ($reversed) $sort_sql .= " ASC";
    else $sort_sql .= " DESC";
    break;
  default:
    $sort_sql = "";
}
//===========================


//This is the base request we will modify soon, according to the parameter the user choose
$sql = "SELECT game.*, AVG(review.score) AS mean_score, COUNT(review.id) AS review_count FROM game $tag_sql LEFT JOIN review ON review.id_game = game.id $search_sql GROUP BY game.id $sort_sql $offset_sql;";
$req = $bdd->prepare($sql);

if ($req->execute($search_terms)) {//We display them
  ?>
  <h2>Search:</h2>
  <section class="game-search">

    <form class="main-form" action="list_games.php" method="get">
      <input type="string" hidden name="s" value="<?php
        echo filter_var($_GET["s"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      ?>" />
      <label>
        Title (contains):
        <input type="string" name="name" placeholder="ex: Wonders" <?php
          if (isset($_GET["name"])) echo "value=\"" . filter_var($_GET["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) . "\"";
        ?> />
      </label>
      <label>Tag :

        <?php
        display_selection_tag_list();
        ?>

      </label>
      <input type="submit" name="search" value="Search" />
    </form>

  </section>
  <h2>Sort by:</h2>
  <section class="options-list">
  <?php
    function search_terms() {
      $res = "";
      if (isset($_GET["name"])) $res .= "&name=" . urlencode($_GET["name"]);
      return $res;
    }

    function echo_sort_method_pair($method_name, $method_id, $name) {

      global $reversed;
      global $order_method;
      if (!$reversed && $order_method === $method_id) {
        echo "<a href=\"?s=$method_name" . search_terms() . "\" class=\"active\">$name</a>";
      } else {
        echo "<a href=\"?s=$method_name" . search_terms() . "\">$name</a>";
      }

      if ($reversed && $order_method === $method_id) {
        echo "<a href=\"?s=!$method_name" . search_terms() . "\" class=\"active\">$name (rev.)</a>";
      } else {
        echo "<a href=\"?s=!$method_name" . search_terms() . "\">$name (rev.)</a>";
      }
    }

    echo_sort_method_pair("name", ORDER_GAMES_NAME, "Name");
    echo_sort_method_pair("price", ORDER_GAMES_PRICE, "Price");
    echo_sort_method_pair("published", ORDER_GAMES_PUBLISHED, "Date published");
    echo_sort_method_pair("score", ORDER_GAMES_SCORE, "Note");
    echo_sort_method_pair("reviews", ORDER_GAMES_REVIEWS, "Review count");
    ?>
  </section>

  <section class="game-list card-list">
  <?php
  while ($res = $req->fetch()) {
    $last_page = false;
    $game = new Game($res["id"], $res["name"], $res["mean_score"], $res["price"], $res["publisher"], !!$res["image"]);
    ?>
    <div class="game card">
      <div class="picture">
        <?php if ($game->has_image) {
          ?>
          <a href="/images/game/<?php echo $game->id ?>.png">
            <img src="/images/game/<?php echo $game->id ?>.png" alt="<?php echo $game->title;?>'s image" />
          </a>
          <?php
        } else {
          ?>
          <a href="/images/game-default.png">
            <img src="/images/game-default.png" alt="Default game image" />
          </a>
          <?php
        }
        ?>
      </div>
      <a class="name" href="game_page.php?id=<?php echo $game->id; ?>">
        <?php echo $game->title; ?>
      </a>
      <div class="info">
        <div class="price">Price: <b><?php if ($game->price === NULL) echo "?"; else echo $game->price; ?>&nbsp;€</b></div>
        <div class="note">Note: <b><?php echo round($game->note, 1); ?>/10</b></div>
        <div class="reviews">Reviews: <b><?php echo $res["review_count"]; ?></b></div>
      </div>
    </div>
    <?php
  }
  ?>
  </section>
  <?php

  echo_page_selector("p", $last_page);
} else {
  ?>
  There was an error querying our database; try again later!
  <?php
}
include_once("../lib/tail.php");
?>
