<?php
$PAGE_NAME = "Create Account";
include_once("../lib/head.php");
include_once("../lib/add_user.php");

if (isset($_POST["submit"])) {
    // TODO: validate and sanitize these values
    $pseudo = $_POST["pseudo"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];
    $country = $_POST["country"];
    $profile_picture = $_POST["profile_picture"];
    $res = add_user(
        $pseudo,
        $email,
        $password,
        $birthdate,
        $country,
        $profile_picture
    );
    if ($res == NULL) {
        // login the user
        header("Location: /");
    } else {
        echo "There was an error while creating your account: " . $res;
    }
}
?>

<h2>Account creation</h2>

<form class="main-form" method="post" action="#">
    <label>
        Pseudo:<input type="text" name="pseudo" required />
    </label>

    <label>
        Email:<input type="email" name="email" required />
    </label>

    <label>
        Password:<input type="password" name="password" required />
    </label>

    <label>
        Birthdate:<input type="date" name="birthdate" required />
    </label>

    <label>Country:</label>
    <select name="country">
        <?php
        // Créer une requête SELECT pour récupérer
        $req = $bdd->prepare("SELECT id, country_name FROM country;");
        // Exécute la requête
        $req->execute();
        // Tant que il y a des données ->
        while($ligne = $req->fetch()) { // On est pas en lo21 donc on a le droit >.>
            echo "<option value=\"$ligne[id]\">$ligne[country_name]</option>";
        }
        ?>
    </select>

    <label>
        Profile picture:<input type="file" name="profile_picture"/>
    </label>

    <input type="submit" name="submit" value="Send"/>
</form>

<?php
include_once("../lib/tail.php");
?>
