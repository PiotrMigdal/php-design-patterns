<?php

interface Shape {
    public function draw();
}
class Position {};

class Rectangle implements Shape {
    private $position;

    public function __construct($pos)
    {
        $this->position = $pos;
    }

    public function draw()
    {
        echo "Drawing a rectangle";
    }
}

class ShapeFactory {
    public function create($type)
    {
        if ($type == "Rectangle") {
            return new Rectangle(new Position()); //If you want to change Position() you can do it here only for all new instances
        }
    }
}

$factory = new ShapeFactory();

$rect = $factory->create("Rectangle");

echo $rect->draw();
