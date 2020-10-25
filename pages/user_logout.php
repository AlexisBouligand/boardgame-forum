<?php

$PAGE_NAME = "Log out";
include_once("../lib/head.php");

unset($_SESSION["pseudonym"]);
unset($_SESSION["username"]);

header("Location: /");
?>

<div>You are now logged out!</div>

<?php

include_once("../lib/tail.php");
?>
