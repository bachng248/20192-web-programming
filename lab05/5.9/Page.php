<?php
  class Page {
    private $page;
    private $title;
    private $year;
    private $copyright;

    function __construct($page, $title, $year, $copyright) {
      $this->page = $page;
      $this->title = $title;
      $this->year = $year;
      $this->copyright = $copyright;
    }

    private function addHeader() {

    }

    private function addFooter() {

    }

    public function addContent($content) {

    }

    public function get() {

    }
  }
?>