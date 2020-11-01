<?php
/// Prints out a page selector "component"; the page is derived from a given GET parameter (`$field_name`) and is 1-indexed
function echo_page_selector(String $field_name = "p", bool $last = false) {
  if (isset($_GET[$field_name]) && is_numeric($_GET[$field_name]) && $_GET[$field_name] > 0 && $_GET[$field_name] == round($_GET[$field_name], 0)) {
    $p = (int)$_GET[$field_name];
  } else {
    $p = 1;
  }

  /// Generate the GET parameters, with as only difference the new page index
  function generate_link(String $field_name, $p) {
    $res = "?$field_name=$p";
    foreach ($_GET as $key => $value) {
      if ($key === $field_name) continue;
      $res .= "&" . urlencode($key) . "=" . urlencode($value);
    }
    return $res;
  }
?>

  <section class="page-selector">
    <?php if ($p > 1) { ?>
      <a href="<?php echo generate_link($field_name, $p - 1); ?>">« Previous</a>
    <?php } else { ?>
      <div class="disabled">« Previous</div>
    <?php } ?>

    <form method="get" action="">
      <input type="number" name="<?php echo $field_name; ?>" value="<?php echo $p; ?>" class="page-number" min="1" />
      <?php
        foreach ($_GET as $key => $value) {
          if ($key === $field_name) continue;
          echo "<input type=\"text\" name=\"";
          echo filter_var($key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          echo "\" value=\"";
          echo filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          echo "\" hidden />";
        }
      ?>
      <input type="submit" name="" value="Go!" class="page-go" />
    </form>


    <?php if (!$last) { ?>
      <a href="<?php echo generate_link($field_name, $p + 1); ?>">Next »</a>
    <?php } else { ?>
      <div class="disabled">Next »</div>
    <?php } ?>
  </section>

<?php
}
?>
