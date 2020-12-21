<?php

namespace App\Pokemon;

class Pokemon
{
    private $name;
    private $baseExperience;
    private $height;

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
