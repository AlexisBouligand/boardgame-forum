<?php

/**
 * Verifies that the image sent as the form field `$field_name` is a valid image with as extension `$extension`.
 * @return true on success, false otherwise.
 */
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

/**
 * @return Whether or not the user uploaded a file as part of the form field `$field_name`.
 */
function has_uploaded(String $field_name) {
  return isset($_FILES[$field_name]) && file_exists($_FILES[$field_name]["tmp_name"]) && is_uploaded_file($_FILES[$field_name]["tmp_name"]);
}

?>
