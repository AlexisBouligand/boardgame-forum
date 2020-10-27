<?php

class Critic {
  public $author = null;
  public $contents = "";
  public $date = 0;
  public $karma = 0;
  public $score = 0;

  public function __construct(
    $author = null,
    $contents = "",
    $date = 0,
    $karma = 0,
    $score = 0
  ) {
    $this->author = $author;
    $this->contents = $contents;
    $this->date = $date;
    $this->karma = $karma;
    $this->score=$score;
  }
}
