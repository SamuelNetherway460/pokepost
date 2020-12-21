<?php

namespace App\Pokemon;

class PokemonGateway
{
    private $baseURL;

    public function __construct($baseURL)
    {
        $this->baseURL = $baseURL;
    }

    public function pokemon($name)
    {
        return [
            'url' => $this->baseURL,
            'name' => $name,
            'base_experience' => 101,
            'height' => 3,
            'base_hp' => 48,
            'base_attack' => 48,
            'base_defense' => 48,
            'base_special_attack' => 48,
            'base_special_defence' => 48,
            'base_speed' => 48,
            'type' => 'normal',
            'weight' => 40,
        ];
    }
}
