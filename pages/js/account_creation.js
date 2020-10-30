const pseudo_input = document.getElementById("pseudo");
const pseudo_label = document.getElementById("pseudo-label");
const password_input = document.getElementById("password");
const submit_button = document.getElementById("submit");

submit_button.disabled = true;
pseudo_input.okay = false;
password_input.okay = false;

let pseudo_xhr;
let pseudo_requested = "";

function pseudo_lookup(value) {
  pseudo_xhr = new XMLHttpRequest();
  pseudo_xhr.open("get", "/get_user.php?name=" + value);
  pseudo_xhr.onload = () => {
    // pseudo_requested = "";
    if (pseudo_xhr.status === 200) {
      let response = JSON.parse(pseudo_xhr.response);
      if (!response.result) {
        pseudo_label.className = "";
        pseudo_input.okay = true;
      } else {
        pseudo_label.className = "already-exists";
        pseudo_input.okay = false;
      }
    } else {
      pseudo_label.className = "";
      pseudo_input.okay = true;
    }
    submit_button.disabled = !pseudo_input.okay || !password_input.okay;
  };
  pseudo_xhr.send();
}

function schedule_pseudo_lookup() {
  if (pseudo_requested != pseudo_input.value) {
    pseudo_lookup(pseudo_input.value);
    pseudo_requested = pseudo_input.value;
  }
}

password_input.oninput = () => {
  password_input.okay = !!PASSWORD_REGEX.exec(password_input.value);
  password_input.className = password_input.okay ? "" : "error";
  submit_button.disabled = !pseudo_input.okay || !password_input.okay;
}

pseudo_input.oninput = () => {
  pseudo_input.okay = !!PSEUDO_REGEX.exec(pseudo_input.value);
  pseudo_input.className = pseudo_input.okay ? "" : "error";
  submit_button.disabled = !pseudo_input.okay || !password_input.okay;
  if (pseudo_input.okay) {
    schedule_pseudo_lookup();
  } else {
    pseudo_requested = "";
    pseudo_label.className = "";
  }
}
