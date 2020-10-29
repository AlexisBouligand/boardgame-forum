<?php

function verify_image_upload(
  String $field_name,
  String $extension,
  int $max_size
) {
  if (!isset($_FILES[$field_name])) return false;

  if (getimagesize($_FILES[$field_name]["tmp_name"]) === false) return false;

  if (
    strtolower(pathinfo(
      $_FILES[$field_name]["name"],
      PATHINFO_EXTENSION
    )) != $extension
  ) {
    return false;
  }

  if ($_FILES[$field_name]["size"] > $max_size) return false;

  return true;
}

?>
