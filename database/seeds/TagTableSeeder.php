<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pokemonGo = new Tag(['name' => 'PokemonGo']);
        $pokemonGo->save();

        $cards = new Tag(['name' => 'Cards']);
        $cards->save();

        $news = new Tag(['name' => 'News']);
        $news->save();

        $funny = new Tag(['name' => 'Funny']);
        $funny->save();

        $event = new Tag(['name' => 'Event']);
        $event->save();

        $raid = new Tag(['name' => 'Raid']);
        $raid->save();

        $gym = new Tag(['name' => 'Gym']);
        $gym->save();

        $pokeStop = new Tag(['name' => 'Poke Stop']);
        $pokeStop->save();

        $trade = new Tag(['name' => 'Trade']);
        $trade->save();

        $battle = new Tag(['name' => 'Battle']);
        $battle->save();

        $shop = new Tag(['name' => 'Shop']);
        $shop->save();

        $item = new Tag(['name' => 'Item']);
        $item->save();

        $pokeball = new Tag(['name' => 'Pokeball']);
        $pokeball->save();

        $pokedex = new Tag(['name' => 'Pokedex']);
        $pokedex->save();

        $eggs = new Tag(['name' => 'Eggs']);
        $eggs->save();

        $walk = new Tag(['name' => 'Walk']);
        $walk->save();
    }
}
