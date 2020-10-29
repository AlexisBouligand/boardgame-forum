<?php
$PAGE_NAME = "Add Game";
include_once("../lib/head.php");
include_once("../lib/add_game.php");

if (isset($_POST["submit"])) {
  // TODO: validate and sanitize
  $name = $_POST["name"];
  $creator = $_POST["creator"];
  $price = $_POST["price"];
  $publisher = $_POST["publisher"];
  $res = add_game(
    $name,
    $creator,
    $price,
    $publisher
  );
  if ($res == NULL) {
      header("Location:../pages/index.php");
  } else {
    echo "There was an error while trying to add your game: " . $res;
  }
}
?>

<h2>Add a Game</h2>

<form class="main-form" method="post" action="game_creation.php">

    <label>Game's name :
    <input type="text" name="name" required/>
    </label>

    <label>Creator :
    <input type="text" name="creator" required/>
    </label>

    <label>Publisher :
    <input type="text" name="publisher" required/>
    </label>

    <label>Price :
    <input type="number" name="price" required/>
    </label>

  <!-- TODO: this -->
  <!-- <input type="submit" name="image_button" value="Game's picture"> -->

  <input type="submit" name="submit" value="Send">
</form>

<?php
include_once("../lib/tail.php");
?>
