<?php
$PAGE_NAME = "Create Account";
include_once("../lib/head.php");
include_once("../lib/add_user.php");

if ($current_user != NULL) {
    // lolno
    header("Location: /");
    die();
}

function try_create_account() {
    // TODO: validate and sanitize these values
    $pseudo = $_POST["pseudo"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];
    $country = $_POST["country"];
    if (isset($_FILES["profile_picture"])) {
        if (!verify_image_upload("profile_picture", "png", 5000000)) {
            return "Invalid image!";
        }
    }

    $res = add_user(
        $pseudo,
        $email,
        $password,
        $birthdate,
        $country,
        isset($_FILES["profile_picture"])
    );

    if ($res == NULL) {
        $user = find_player_by_name($pseudo);
        if (!$user || !$user->password_verify($password)) {
            return "Your account couldn't be created for mysterious reasons...";
        }

        if (isset($_FILES["profile_picture"])) {
            $target_pp_file = "./images/user/" . $user->id . ".png";
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_pp_file);
        }

        // login the user
        header("Location: /user_login.php");
        return "";
    } else {
        return "There was an error while creating your account: " . $res;
    }
}

if (isset($_POST["submit"])) {
    echo try_create_account();
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
        // Créer une requête SELECT pour récupérer les pays
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
