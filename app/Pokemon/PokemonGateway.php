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
        $baseExperience = $jsonPokemon['base_experience'];
        $height = $jsonPokemon['height'];
        $weight = $jsonPokemon['weight'];
        $moves = $this->parse_json_moves($jsonPokemon);
        $stats = $this->parse_json_stats($jsonPokemon);
        if (array_key_exists('hp', $stats)) $hp = $stats['hp'];
        if (array_key_exists('attack', $stats)) $attack = $stats['attack'];
        if (array_key_exists('special-attack', $stats)) $specialAttack = $stats['special-attack'];
        if (array_key_exists('defense', $stats)) $defence = $stats['defense'];
        if (array_key_exists('special-defense', $stats)) $specialDefence = $stats['special-defense'];
        if (array_key_exists('speed', $stats)) $speed = $stats['speed'];
        $types = $this->parse_json_types($jsonPokemon);

        $pokemon = new Pokemon($name, $abilities, $baseExperience, $height, $weight,
            $moves, $hp, $attack, $specialAttack, $defence, $specialDefence, $speed, $types);
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
        foreach($abilitiesArray as $ability) {
            $parsedAbility = $ability['ability']['name'];
            $formattedAbility = str_replace('-', ' ', $parsedAbility);
            array_push($abilities, $formattedAbility);
        }
        return $abilities;
    }

    /**
     * Parses the moves for a JSON Pokemon object.
     *
     * @param JSON $jsonPokemon
     * @return array
     */
    private function parse_json_moves($jsonPokemon)
    {
        $moves = [];
        $movesArray = $jsonPokemon['moves'];
        foreach($movesArray as $move) {
            $parsedMove = $move['move']['name'];
            $formattedMove = str_replace('-', ' ', $parsedMove);
            array_push($moves, $formattedMove);
        }
        return $moves;
    }

    /**
     * Parses the stats for a JSON Pokemon object.
     *
     * @param JSON $jsonPokemon
     * @return array
     */
    private function parse_json_stats($jsonPokemon)
    {
        $jsonStatsArray = $jsonPokemon['stats'];
        $stats = [];
        foreach($jsonStatsArray as $stat) {
            $name = $stat['stat']['name'];
            $value = $stat['base_stat'];
            $stats[$name] = $value;
        }
        return $stats;
    }

    /**
     * Parses the types for a JSON Pokemon Object.
     *
     * @param JSON $jsonPokemon
     * @return array
     */
    private function parse_json_types($jsonPokemon) {
        $types = [];
        $jsonTypes = $jsonPokemon['types'];
        foreach($jsonTypes as $type) {
            array_push($types, $type['type']['name']);
        }
        return $types;
    }
}
