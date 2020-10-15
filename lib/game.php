<?php

class Game {
  public $title = null;
  public $note = 0.5; // from 0 to 1
  public $price = 0;
  public $publisher = null;

  public function __construct(
    $title = null,
    $note = 0.5,
    $price = 0,
    $publisher = null
  ) {
    $this->title = $title;
    $this->note = $note;
    $this->price = $price;
    $this->publisher = $publisher;
  }
}

?>
