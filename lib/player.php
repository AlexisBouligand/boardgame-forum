<?php

class Player {
  public $id = 0;
  public $username = null;
  public $birth_date = 0;
  public $country = null;
  public $has_profile_picture = null;
  private $hashed_password = "";

  public function __construct(
    $id = 0,
    $username = null,
    $birth_date = 0,
    $country = null,
    $hashed_password = "",
    $has_profile_picture = false
  ) {
    $this->id = $id;
    $this->birth_date = $birth_date;
    $this->username = $username;
    $this->country = $country;
    $this->hashed_password = $hashed_password;
    $this->has_profile_picture = $has_profile_picture;
  }

  //C'est l'affichage d'un joueur, avec un bouton Follow
  public function draw_card() {
    ?>
    <article class="player-profile">
      <div class="picture-and-nickname">
        <?php if ($this->has_profile_picture) { ?>
          <a href="/images/user/<?php echo $this->id; ?>.png">
            <img src="/images/user/<?php echo $this->id; ?>.png" alt="PP" />
          </a>
        <?php } else { ?>
          <a href="/images/user-default.png">
            <img src="/images/user-default.png" alt="PP" />
          </a>
        <?php } ?>
        <h2 class="nickname"><?php echo $this->username; ?></h2>
      </div>

      <div class="profile-info">
        <span>
          Né(e) le <?php echo $this->birth_date; ?>
        </span>
        <span>
          Pays: <?php echo $this->country; ?>
        </span>
      </div>

      <form class="follow" method="post">
        <label><input type="submit" name="follow" value="Follow"></label>
      </form>

        <?php
        // Une fois que le joueur a cliqué sur le bouton follow il est redirigé ici
        if(isset($_POST["follow"]))
        {
            header("Location:../lib/add_friend.php?id=$this->id");
        }
        ?>
    </article>
    <?php
  }


  public function password_verify($password) {
    return $this->hashed_password && password_verify($password, $this->hashed_password);
  }
}





function try_login($username, $password) {
  global $current_user;

  if ($user = find_player_by_name($username)) {
    if($user->password_verify($password)) {
      $current_user = $user;
      // echo $current_user->country;
      return true;
    }
  }
  return false;
}

function find_player_by_name($username) {
  global $bdd;
  $req = $bdd->prepare("SELECT id, birthdate, country, password, profile_picture FROM user WHERE user.pseudonym = ?;");

  if ($req->execute([$username]) && ($res = $req->fetch())) {
    $country_req = $bdd->prepare("SELECT country_name FROM country WHERE id = ?");

    if ($country_req->execute([$res["country"]])) {
      $country_res = $country_req->fetch()["country_name"];
    } else {
      $country_res = "Unknown";
    }

    return new Player($res["id"], $username, $res["birthdate"], $country_res, $res["password"], !!$res["profile_picture"]);
  } else {
    return false;
  }
}

?>
