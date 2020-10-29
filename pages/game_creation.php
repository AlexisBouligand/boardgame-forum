<?php
$PAGE_NAME = "Add Game";
include_once("../lib/head.php");
include_once("../lib/add_game.php");

function try_create_game() {
  // TODO: validate and sanitize
  $name = $_POST["name"];
  $creator = $_POST["creator"];
  $price = $_POST["price"];
  $publisher = $_POST["publisher"];
  if (isset($_FILES["image"])) {
    if (!verify_image_upload("image", "png", 5000000)) {
      return "Invalid image file!";
    }
  }
  $res = add_game(
    $name,
    $creator,
    $price,
    $publisher,
    issert($_FILES["image"])
  );
  if ($res == NULL) {
      header("Location: /");
  } else {
    return "There was an error while trying to add your game: " . $res;
  }
}

if (isset($_POST["submit"])) {
  echo try_create_game();
}
?>

<h2>Add a Game</h2>

<form class="main-form" method="post" action="game_creation.php">

  <label>Game's name:
    <input type="text" name="name" required />
  </label>

  <label>Creator:
    <input type="text" name="creator" required />
  </label>

  <label>Publisher:
    <input type="text" name="publisher" required />
  </label>

  <label>Price:
    <input type="number" name="price" required />
  </label>

  <!-- TODO: this -->
  <label>Image:
    <input type="file" name="image" />
  </label>

  <input type="submit" name="submit" value="Send">
</form>

<?php
include_once("../lib/tail.php");
?>
