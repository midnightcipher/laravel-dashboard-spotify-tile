<?php

namespace Ashbakernz\SpotifyTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class SpotifyTileServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchDataFromSpotifyCommand::class,
                RefreshAccessTokenSpotifyCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-spotify-tile'),
        ], 'dashboard-spotify-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-spotify-tile');
        $this->loadRoutesFrom(__DIR__.'/Routes.php');

        Livewire::component('spotify-tile', SpotifyTileComponent::class);
    }
}
