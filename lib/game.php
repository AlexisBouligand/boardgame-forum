<?php

class Game {
  public $id = 0;
  public $title = null;
  public $note = 0.5; // from 0 to 1
  public $price = 0;
  public $publisher = null;
  public $has_image = false;

  public function __construct(
    $id = 0,
    $title = null,
    $note = 0.5,
    $price = 0,
    $publisher = null,
    $has_image = false
  ) {
    $this->id = $id;
    $this->title = $title;
    $this->note = $note;
    $this->price = $price;
    $this->publisher = $publisher;
    $this->has_image = $has_image;
  }
}

?>
