<?php

namespace App\Providers;

use App\Pokemon\PokemonGateway;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PokemonGateway::class, function($app) {
            return new PokemonGateway('https://pokeapi.co/api/v2/pokemon/');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
