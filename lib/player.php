<?php

class Player {
  public $id = 0;
  public $username = null;
  public $birth_date = 0;
  public $country = null;
  public $has_profile_picture = null;
  public $followed = false;
  private $hashed_password = "";

  //Initialize the class
  public function __construct(
    $id = 0,
    $username = null,
    $birth_date = 0,
    $country = null,
    $hashed_password = "",
    $has_profile_picture = false,
    $followed = false
  ) {
    $this->id = $id;
    $this->birth_date = $birth_date;
    $this->username = $username;
    $this->country = $country;
    $this->hashed_password = $hashed_password;
    $this->has_profile_picture = $has_profile_picture;
    $this->followed = $followed;
  }

  /** Prints out a player as a "card", with a "Follow/unfollow" button */
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
        <a href="/user.php?id=<?php echo $this->id; ?>" class="nickname"><?php echo htmlspecialchars($this->username); ?></a>
      </div>

      <div class="profile-info">
        <span>
          Né(e) le <?php echo $this->birth_date; ?>
        </span>
        <span>
          Pays: <?php echo $this->country; ?>
        </span>
      </div>

      <label class="follow">
        <button type="button" onclick="follow(<?php echo $this->id; ?>, this);" <?php
          if ($this->followed) {
            ?>
            class="followed">Unfollow
            <?php
          } else {
            ?>
            >Follow
            <?php
          }
          ?>
          </button>
      </label>
    </article>
    <?php
  }

  /** Verifies the given `$password` against the stored, hashed password.
   * @return true if the given password corresponds to the hashed one, false otherwise
   */
  public function password_verify($password) {
    return $this->hashed_password && password_verify($password, $this->hashed_password);
  }
}




//Check if the login user informations are correct
function try_login($username, $password) {
  global $current_user;

  if ($user = find_player_by_name($username)) {
    if($user->password_verify($password)) {
      $current_user = $user;
      return true;
    }
  }
  return false;
}

/// Finds a player by a given sql property (`$trait`) and returns its corresponding, full `Player` instance; this function shouldn't be used outside of this file
function find_player_by($trait, $value) {
  global $bdd;
  global $current_user;
  $req = $bdd->prepare("SELECT pseudonym, id, birthdate, country, password, profile_picture FROM user WHERE $trait = ?;");

  if ($req->execute([$value]) && ($res = $req->fetch())) {
    $country_req = $bdd->prepare("SELECT country_name FROM country WHERE id = ?");
    $followed_req = $bdd->prepare("SELECT * FROM follows WHERE id_user = ? AND id_friend = ?;");

    if ($country_req->execute([$res["country"]])) {
      $country_res = $country_req->fetch()["country_name"];
    } else {
      $country_res = "Unknown";
    }

    if ($current_user != NULL && $followed_req->execute([$current_user->id, $res["id"]])) {
      $followed = !!$followed_req->fetch();
    } else {
      $followed = false;
    }

    return new Player($res["id"], $res["pseudonym"], $res["birthdate"], $country_res, $res["password"], !!$res["profile_picture"], $followed);
  } else {
    return false;
  }
}

/**
 * Finds a player based on its pseudonym/username
 * @return Player
 */
function find_player_by_name($name) {
  return find_player_by("pseudonym", $name);
}

/**
 * Finds a player based on its ID
 * @return Player
 */
function find_player_by_id($id) {
  return find_player_by("id", $id);
}

?>
