<?php

//Take the informations of a user as parameters
//Insert this information in the database
//Return an error or not
function add_user(
    String $pseudo,
    String $email,
    String $password,
    String $birthdate,
    String $country,
    bool $profile_picture
) {
    global $bdd;
    try {
        // We prepare the Insert request
        $req = $bdd->prepare("INSERT INTO user (pseudonym, email, password, profile_picture, country, birthdate) VALUES (?, ?, ?, ?, ?, ?);");
        //We send the user informations
        if ($req->execute([$pseudo, $email, password_hash($password, PASSWORD_BCRYPT), $profile_picture ? 1 : 0, $country, $birthdate])) {
            return NULL;
        } else {
            return "Uh oh!";
        }
    } catch (Exception $exception) {
        return $exception;
    }
}
?>
