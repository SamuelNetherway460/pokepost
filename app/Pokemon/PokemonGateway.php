<?php

namespace App\Pokemon;
use Illuminate\Support\Facades\Http;

class PokemonGateway
{
    private $baseURL;

    public function __construct($baseURL)
    {
        $this->baseURL = $baseURL;
    }

    public function pokemon($name)
    {
        $jsonPokemon = $this->queryPokeAPI($name);
        $pokemon = $this->parse_json_pokemon($jsonPokemon);
        return $pokemon;
    }

    private function queryPokeAPI($name)
    {
        return Http::get($this->baseURL . $name)->json();
    }

    private function parse_json_pokemon($jsonPokemon)
    {
        $name = $jsonPokemon['name'];
        $baseExperience = $jsonPokemon['base_experience'];
        $height = $jsonPokemon['height'];
        $pokemon = new Pokemon($name, $baseExperience, $height);
        return $pokemon;
    }
}
