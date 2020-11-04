<?php

class Critic {
  public $id = 0;
  public $author = null;
  public $contents = "";
  public $date = 0;
  public $karma = 0;
  public $score = 0;
  public $current_vote;

  public function __construct(
    $id = 0,
    $author = null,
    $contents = "",
    $date = 0,
    $karma = 0,
    $score = 0,
    $current_vote = 0
  ) {
    $this->id = $id;
    $this->author = $author;
    $this->contents = $contents;
    $this->date = $date;
    $this->karma = $karma;
    $this->score = $score;
    $this->current_vote = $current_vote;
  }
}
