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


    public function __construct($name, $baseExperience, $height)
    {
        $this->name = $name;
        $this->baseExperience = $baseExperience;
        $this->height = $height;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_base_experience()
    {
        return $this->baseExperience;
    }

    public function get_height()
    {
        return $this->height;
    }
}
