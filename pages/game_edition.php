<?php
$PAGE_NAME = "Add Game";
include_once("../lib/head.php");
include_once("../lib/selection_tag_list.php");

//Need the id of a game and to know if there is an image to update (bool)
//Try to edit the game by updating its data
//Return if the game was successfully updated
function try_edit_game($id, bool $had_image) {
  global $bdd;
  $name = $_POST["name"];
  $creator = $_POST["creator"];
  $price = $_POST["price"];
  $publisher = $_POST["publisher"];
  //If there is a tag to remove
  if($_POST["tag_to_remove"] != "none") {
    $tag_to_delete = $_POST["tag_to_remove"];
  } else {
    $tag_to_delete = -1;
  }
  if ($_POST["tag_to_add"] != "none") {
    $tag_to_add = $_POST["tag_to_add"];
  } else {
    $tag_to_add = -1;
  }


  if (has_uploaded("image")) {
    if (!verify_image_upload("image", "png", 5000000)) {
      return "Invalid image file!";
    }
  }

  $req = $bdd->prepare("UPDATE game SET name = :name, creator = :creator, publisher = :publisher, price = :price, image = :has_image WHERE id = :id");
  $remove_tag_req = $bdd->prepare("DELETE FROM relation_tag WHERE id_tag = :id_tag");
  $add_tag_req = $bdd->prepare("INSERT INTO relation_tag VALUES (:game_id, :tag_id)");

    //We execute the requests
  if (
    $req->execute(array(
      "id" => $id,
      "name" => $name,
      "creator" => $creator,
      "price" => $price,
      "publisher" => $publisher,
      "has_image" => $had_image || has_uploaded("image") ? 1 : 0
    ))
    && ($tag_to_delete == -1 || $remove_tag_req->execute(["id_tag" => $tag_to_delete]))
    && ($tag_to_add == -1 || $add_tag_req->execute(["game_id" => $id,"tag_id" => $tag_to_add]))
  ) {
    if (has_uploaded("image")) {
      $target_image_file = "./images/game/" . ((int)$id) . ".png";
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
    echo try_edit_game(filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT), $game->has_image);
    echo "</div>";
    $game = find_game_by_id($_GET["id"]);
  }

  ?>

  <h2>Edit a Game: <?php echo filter_var($game->title, FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?></h2>

  <form class="main-form" method="post" enctype="multipart/form-data" action="game_edition.php?id=<?php echo $game->id; ?>">
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

      <label>Add a tag:
          <?php
          display_selection_tag_list("tag_to_add");
          ?>
      </label>
      <label>
          Remove a tag:
          <?php
          display_selection_tag_list("tag_to_remove");
          ?>
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
