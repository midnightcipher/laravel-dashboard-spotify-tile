<?php

namespace AshBakernz\SpotifyTile;

use Ashbakernz\SpotifyTile\SpotifyStore;
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

        $spotifyStore = SpotifyStore::make();

        return view('dashboard-spotify-tile::tile', [
            'refreshIntervalInSeconds' => config('dashboard.tiles.spotify.refresh_interval_in_seconds') ?? 60,
            'isPlaying' => $spotifyStore->getIsPlaying(),
            'trackName' => $spotifyStore->getTrackName(),
            'albumImage' => $spotifyStore->getAlbumImage(),
            'artists' => $spotifyStore->getArtists()
        ]);
    }
}
