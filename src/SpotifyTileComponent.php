<?php

namespace AshBakernz\SpotifyTile;

use Livewire\Component;

class SpotifyTileComponent extends Component
{
    /** @var string */
    public $position;

    public function mount(string $position)
    {
        $this->position = $position;
    }

    public function render()
    {
//        return view('dashboard-spotify-tile::tile');
        return view('dashboard-spotify-tile::tile', [
        'refreshIntervalInSeconds' => config('dashboard.tiles.spotify.refresh_interval_in_seconds') ?? 60,
]);
    }
}
