const pseudo_input = document.getElementById("pseudo");
const password_input = document.getElementById("password");
const submit_button = document.getElementById("submit");

submit_button.disabled = true;
pseudo_input.okay = false;
password_input.okay = false;

/// Validates the username/pseudo
pseudo_input.oninput = function() {
  pseudo_input.okay = !!PSEUDO_REGEX.exec(pseudo_input.value);
  pseudo_input.className = pseudo_input.okay ? "" : "error";
  submit_button.disabled = !pseudo_input.okay || !password_input.okay;
}

/// Validates the password
password_input.oninput = function() {
  password_input.okay = !!PASSWORD_REGEX.exec(password_input.value);
  password_input.className = password_input.okay ? "" : "error";
  submit_button.disabled = !pseudo_input.okay || !password_input.okay;
}
