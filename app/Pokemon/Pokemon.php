<?php

namespace App\Pokemon;

class Pokemon
{
    public $name = 'No Info';
    public $baseExperience = 'No Info';
    public $height = 'No Info';
    public $weight = 'No Info';
    public $abilities = [];
    public $moves = [];
    public $hp = 'No Info';
    public $attack = 'No Info';
    public $specialAttack = 'No Info';
    public $speed = 'No Info';
    public $types = [];
    public $defence = 'No Info';
    public $specialDefence = 'No Info';

    public function __construct($name, $abilities, $baseExperience, $height, $weight,
        $moves, $hp, $attack, $specialAttack, $defence, $specialDefence, $speed, $types)
    {
        $this->name = $name;
        $this->baseExperience = $baseExperience;
        $this->height = $height;
    }
}
