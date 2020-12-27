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

    /**
     * Parses a JSON Pokemon Object.
     *
     * @param JSON $jsonPokemon
     * @return App\Pokemon $pokemon
     */
    private function parse_json_pokemon($jsonPokemon)
    {
        $name = $jsonPokemon['name'];
        $abilities = $this->parse_json_abilities($jsonPokemon);
        dd($abilities);

        $baseExperience = $jsonPokemon['base_experience'];
        $height = $jsonPokemon['height'];
        $pokemon = new Pokemon($name, $baseExperience, $height);
        return $pokemon;
    }

    /**
     * Parses the abilities for a JSON Pokemon object.
     *
     * @param JSON $jsonPokemon
     * @return $abilities
     */
    private function parse_json_abilities($jsonPokemon)
    {
        $abilities = [];
        $abilitiesArray = $jsonPokemon['abilities'];
        foreach ($abilitiesArray as $ability) {
            $parsedAbility = $ability['ability']['name'];
            $formattedability = str_replace('-', ' ', $parsedAbility);
            array_push($abilities, $formattedability);
        }
        return $abilities;
    }
}
