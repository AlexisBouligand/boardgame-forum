/// Called by the follow button
function follow(id, self) {
  let xhr = new XMLHttpRequest();
  xhr.open("get", "/api/add_friend.php?id=" + id);

  self.className = "thinking";

  xhr.onerror = console.error;
  xhr.onload = () => {
    if (xhr.status === 200) {
      let response = JSON.parse(xhr.response);
      if (response.result !== "ok") {
        console.error(response.error);
      } else {
        if (response.follows) {
          self.className = "followed";
          self.innerHTML = "Unfollow"
        } else {
          self.className = "";
          self.innerHTML = "Follow"
        }
      }
    }
  };

  xhr.send();
}

/// Validator for pseudos; reflected in `prelude.php`
const PSEUDO_REGEX = /^[a-zA-Z0-9_-]{3,20}$/;

/// Validator for passwords; reflected in `prelude.php`
const PASSWORD_REGEX = /^.{8,}$/;
