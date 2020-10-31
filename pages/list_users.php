<?php
$PAGE_NAME = "Accueil";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/list_users.css\" />";
include_once("../lib/head.php");
include_once ("../lib/player.php");

$last_page = true;
$search_sql = "";
$search_terms = [];

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

if (isset($_GET["name"])) {
  append_search_sql(
    "pseudonym LIKE CONCAT('%', :name, '%')",
    "name",
    $_GET["name"]
  );
}


if (isset($_GET["p"]) && is_numeric($_GET["p"]) && $_GET["p"] > 0 && $_GET["p"] == round($_GET["p"], 0)) {
  $page = (int)$_GET["p"] - 1;
} else {
  $page = 0;
}

if (isset($_GET["following"]) && $current_user) {
  $query_sql = "SELECT id FROM user INNER JOIN follows ON follows.id_user = :current_user_id AND follows.id_friend = user.id";
  $search_terms["current_user_id"] = $current_user->id;
} else if (isset($_GET["followers"]) && $current_user) {
  $query_sql = "SELECT id FROM user INNER JOIN follows ON follows.id_friend = :current_user_id AND follows.id_user = user.id";
  $search_terms["current_user_id"] = $current_user->id;
} else {
  $query_sql = "SELECT id FROM user";
}

$sql = "$query_sql $search_sql GROUP BY user.id ORDER BY user.id LIMIT " . ($page * $users_page_length) . ", $users_page_length;";
// echo $sql . "<br />";
// echo var_dump($search_terms) . "<br /><br />";
$req = $bdd->prepare($sql);

$search_res = [];

if ($req->execute($search_terms)) {
  while ($res = $req->fetch()) {
    $search_res[] = find_player_by_id($res["id"]);
  }
} else {
  echo "There was an error while trying to list users!";
  echo var_dump($req->errorInfo());
}

?>

<h2>Search for a Friend:</h2>
<form class="main-form search-player" method="get" action="list_users.php" id="pseudo_search">
  <label>
    Name (contains):
    <input type="text" name="name" id="name" size="40" maxlength="30" placeholder="ex: solo" <?php
      if (isset($_GET["name"])) {
        echo "value=\"" . $_GET["name"] . "\"";
      }
    ?> />
  </label>
  <?php if (isset($_GET["following"])) { ?>
    <input type="text" name="following" value="" hidden />
  <?php } else if (isset($_GET["followers"])) { ?>
    <input type="text" name="followers" value="" hidden />
  <?php } ?>
  <input type="submit" name="" value="Search" />
</form>

<h2>
Filter by:
</h2>

<section class="options-list">
  <?php
    function echo_link(String $url_appendix, String $contents, bool $active = false) {
      if ($active) {
        echo "<a class=\"active\" href=\"";
      } else {
        echo "<a href=\"";
      }
      echo "?name=" . filter_var($_GET["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      echo "&p=" . ($page + 1);
      echo "&$url_appendix";
      echo "\">$contents</a>";
    }

    echo_link("", "All", !isset($_GET["following"]) && !isset($_GET["followers"]));
    echo_link("following=", "Following", isset($_GET["following"]));
    echo_link("followers=", "Followers", isset($_GET["followers"]));
  ?>

</section>

<section class="profiles card-list">
  <?php
  foreach ($search_res as $player) {
    $last_page = false;
    $player->draw_card();
  }
  ?>
</section>

<?php
echo_page_selector("p", $last_page);
?>

<?php
include_once("../lib/tail.php");
?>
