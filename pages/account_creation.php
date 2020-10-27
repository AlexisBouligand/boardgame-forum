<?php
$PAGE_NAME = "Create Account";
include_once("../lib/head.php");
include_once("../lib/add_user.php");

if ($current_user != NULL) {
    // lolno
    header("Location: /");
    die();
}

if (isset($_POST["submit"])) {
    // TODO: validate and sanitize these values
    $pseudo = $_POST["pseudo"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];
    $country = $_POST["country"];
    if (isset($_FILES["profile_picture"])) {
        $profile_picture = getimagesize($_FILES["profile_picture"]["tmp_name"]);
        $image_file_type = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
    } else {
        echo var_dump($_FILES);
        $profile_picture = false;
        die();
    }
    // ASSERT($image_file_type == "png")
    // ASSERT($_FILES["profile_picture]["size"] < 500000)

    $res = add_user(
        $pseudo,
        $email,
        $password,
        $birthdate,
        $country,
        $profile_picture !== false
    );

    if ($res == NULL) {
        try_login($pseudo, $password);
        if ($current_user == NULL) {
            echo "Your account couldn't be created for mysterious reasons...";
        } else {
            $target_pp_file = "./images/user/" . $current_user->id . ".png";
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_pp_file);
            // login the user
            header("Location: /user_login.php");
        }
    } else {
        echo "There was an error while creating your account: " . $res;
    }
}
?>

<h2>Account creation</h2>

<form enctype="multipart/form-data" class="main-form" method="post" action="account_creation.php">
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
        Profile picture:<input type="file" name="profile_picture" id="profile_picture" />
    </label>

    <input type="submit" name="submit" value="Send"/>
</form>

<?php
include_once("../lib/tail.php");
?>
