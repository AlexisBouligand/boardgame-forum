<?php
$PAGE_NAME = "Create Account";
include_once("../lib/head.php");
?>

<h2>Account creation</h2>

<form class="main-form" method="post" action="../lib/add_user.php">

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
        // Se connecter à la base de données
        $bdd = new PDO("mysql:host=localhost;dbname=boardgameforum;charset=utf8", "root", "");
        // Créer une requête SELECT pour récupérer
        $req = $bdd->prepare("SELECT id, country_name FROM country;");
        // Exécute la requête
        $req->execute();
        // Tant que il y a des données ->
        $ligne = $req->fetch();
        while($ligne) {
            echo "<option value=\"$ligne[id]\">$ligne[country_name]</option>";
            $ligne = $req->fetch();                     // Passer à la ligne suivante
        }
        ?>
    </select>


    <label>
        profile picture:<input type="file" name="profile_picture"/>
    </label>

    <input type="submit" name="send_button" value="Send"/>
</form>

<?php
include_once("../lib/tail.php");
?>
