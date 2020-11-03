<?php
$PAGE_NAME = "Create Account";
$PAGE_HEAD = "<script src=\"/js/account_creation.js\" defer></script><link rel=\"stylesheet\" href=\"/css/account_creation.css\" />";
include_once("../lib/head.php");
include_once("../lib/add_user.php");

if ($current_user != NULL) {
    // lolno
    header("Location: /");
    die();
}

//We check if the user informations are valid and if the game can be add
//Return an error or not
function try_create_account() {
    global $bdd;
    $pseudo = $_POST["pseudo"];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $birthdate = $_POST["birthdate"];
    $country = $_POST["country"];

    //LThe differentes filed must fit the format
    if (!preg_match(PSEUDO_REGEX, $pseudo)) return "Invalid pseudo!";
    if (!preg_match(PASSWORD_REGEX, $password)) return "Invalid password!";
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) return "Invalid email!";
    if (!strtotime($birthdate)) return "Invalid birth date!";

    //We check the country
    $country_req = $bdd->prepare("SELECT * FROM country WHERE id = ?");
    if (!$country_req->execute([$country]) || !$country_req->fetch()) return "Invalid country!";

    //We check if the username already exists
    if ($user = find_player_by_name($pseudo)) {
        return "Couldn't create account: username already taken!";
    }

    //We check the image size
    if (has_uploaded("profile_picture")) {
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
        has_uploaded("profile_picture")
    );

    if ($res == NULL) {
        $user = find_player_by_name($pseudo);
        if (!$user || !$user->password_verify($password)) {
            return "Your account couldn't be created for mysterious reasons...";
        }

        if (has_uploaded("profile_picture")) {
            $target_pp_file = "./images/user/" . $user->id . ".png";
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_pp_file);
        }

        // login the user
        header("Location: user_login.php");
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
    <label id="pseudo-label">
        Pseudo:<input type="text" name="pseudo" id="pseudo" required />
    </label>

    <label>
        Email:<input type="email" name="email" id="email" required />
    </label>

    <label>
        Password:<input type="password" name="password" id="password" required />
    </label>

    <label>
        Birthdate:<input type="date" name="birthdate" required />
    </label>

    <label>Country:</label>
    <select name="country">
        <?php
        //We get the countries with a SQL request
        $req = $bdd->prepare("SELECT id, country_name FROM country;");
        // We execute it
        $req->execute();
        // While there is data
        while($ligne = $req->fetch()) { // On est pas en lo21 donc on a le droit >.>
            echo "<option value=\"$ligne[idfet]\">$ligne[country_name]</option>";
        }
        ?>
    </select>

    <label>
        Profile picture:<input type="file" name="profile_picture" id="profile_picture" />
    </label>

    <input type="submit" name="submit" value="Send" id="submit" />
</form>

<?php
include_once("../lib/tail.php");
?>
