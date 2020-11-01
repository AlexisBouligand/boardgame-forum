<?php
$PAGE_NAME = "Add Game";
include_once("../lib/head.php");

function try_edit_game($id, bool $had_image) {
  global $bdd;
  $name = $_POST["name"];
  $creator = $_POST["creator"];
  $price = $_POST["price"];
  $publisher = $_POST["publisher"];

  if (has_uploaded("image")) {
    if (!verify_image_upload("image", "png", 5000000)) {
      return "Invalid image file!";
    }
  }

  $req = $bdd->prepare("UPDATE game SET name = :name, creator = :creator, publisher = :publisher, price = :price, image = :has_image WHERE id = :id");

  if ($req->execute(array(
    "id" => $id,
    "name" => $name,
    "creator" => $creator,
    "price" => $price,
    "publisher" => $publisher,
    "has_image" => $had_image || has_uploaded("image") ? 1 : 0
  ))) {
    if (has_uploaded("image")) {
      $target_image_file = "./images/game/" . $game->id . ".png";
      move_uploaded_file($_FILES["image"]["tmp_name"], $target_image_file);
    }

    return "Game successfully updated!";
  } else {
    return "Error while trying to update game!" . var_dump($req->errorInfo());
  }
}

if (isset($_GET["id"]) && $game = find_game_by_id($_GET["id"])) {
  if (isset($_POST["submit"])) {
    echo "<div class=\"result\">";
    echo try_edit_game($_GET["id"], $game->has_image);
    echo "</div>";
    $game = find_game_by_id($_GET["id"]);
  }

  ?>

  <h2>Edit a Game: <?php echo filter_var($game->title, FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?></h2>

  <form class="main-form" method="post" action="game_edition.php?id=<?php echo $game->id; ?>">
    <label>Game's name:
      <input type="text" name="name" value="<?php echo filter_var($game->title, FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>" required />
    </label>

    <label>Creator:
      <input type="text" name="creator" value="<?php echo filter_var($game->creator, FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>" required />
    </label>

    <label>Publisher:
      <input type="text" name="publisher" value="<?php echo filter_var($game->publisher, FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>" required />
    </label>

    <label>Price:
      <input type="number" class="price" name="price" min="0" step="0.01" placeholder="9.99" value="<?php echo filter_var($game->price, FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>" required />
      €
    </label>

    <!-- TODO: this -->
    <label>Image:
      <input type="file" name="image" />
    </label>

    <input type="submit" name="submit" value="Send">
  </form>

  <div class="vertical-spacer"></div>

  <a href="/game_page.php?id=<?php echo $game->id; ?>" class="center gray">Game page</a>

  <?php
} else {
  echo "Couldn't find game!";
}

include_once("../lib/tail.php");
?>
