<?php

namespace App\Pokemon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class PokemonGateway
{
    private $baseURL;

    public function __construct($baseURL)
    {
        $this->baseURL = $baseURL;
    }

    public function pokemon($name)
    {
        $response = $this->queryPokeAPI($name);
        $pokemon = null;
        if ($response != null)
        {
            $pokemon = $this->parse_json_pokemon($response->json());
        }
        else
        {
            $pokemon = new Pokemon("error", 0, 0);
        }
        return $pokemon;
    }

    private function queryPokeAPI($name)
    {
        $response = null;
        try {
            $response = Http::get($this->baseURL . $name)->throw();
        } catch (ConnectionException $e) {

        }
        return $response;
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
