<?php
$PAGE_NAME = "Add Game";
include_once("../lib/head.php");
include_once("../lib/add_game.php");
include_once("../lib/selection_tag_list.php");



//We check if the game informations are valid and if the game can be add
//Return an error or not
function try_create_game() {
  // TODO: validate and sanitize
  $name = $_POST["name"];
  $creator = $_POST["creator"];
  $price = $_POST["price"];
  $publisher = $_POST["publisher"];
  //If there is a tag associated
  if($_POST['tag']!='none')
  {
      $tag_id = $_POST["tag"];

  }
  else
  {
      $tag_id=-1;

  }

  if (has_uploaded("image")) {
    if (!verify_image_upload("image", "png", 5000000)) {
      return "Invalid image file!";
    }
  }

  if (find_game_by_name($name)) {
    return "A game with the same name already exists!";
  }

  $res = add_game(
    $name,
    $creator,
    $price,
    $publisher,
    has_uploaded("image"),
    $tag_id

  );

  $game = find_game_by_name($name);
  if (!$game) return "The game couldn't be crated for mysterious reasons...";

  if (has_uploaded("image")) {
    $target_image_file = "./images/game/" . $game->id . ".png";
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_image_file);
  }

  if ($res == NULL) {
      header("Location:game_page.php?name=$name");
  } else {
    return "There was an error while trying to add your game: " . $res;
  }
}

if (isset($_POST["submit"])) {
  echo try_create_game();
}
?>

<h2>Add at Game</h2>

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

    <label>Tag :
        <?php
       display_selection_tag_list();
        ?>
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


<!--easter egg-->
