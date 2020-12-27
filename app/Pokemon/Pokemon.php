<?php

namespace App\Pokemon;

class Pokemon
{
    public $name;
    public $baseExperience;
    public $height;
    public $weight;
    public $abilities;
    public $moves;
    public $hp;
    public $attack;
    public $specialAttack;
    public $speed;
    public $types;
    public $defence;
    public $specialDefence;

    public function __construct($name, $abilities, $baseExperience, $height, $weight,
        $moves, $hp, $attack, $specialAttack, $defence, $specialDefence, $speed, $types)
    {
        $this->name = $name;
        $this->abilities = $abilities;
        $this->baseExperience = $baseExperience;
        $this->height = $height;
        $this->weight = $weight;
        $this->moves = $moves;
        $this->hp = $hp;
        $this->attack = $attack;
        $this->specialAttack = $specialAttack;
        $this->defence = $defence;
        $this->specialDefence = $specialDefence;
        $this->speed = $speed;
        $this->types = $types;
    }
}
