<?php
    //require "Polygon.php";
  class Circle extends Shape {
    public $radius;

    public function getArea() {
      return pi() * $this->radius * $this->radius;
    }
  }
?>