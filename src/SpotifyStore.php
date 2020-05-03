<?php

namespace Ashbakernz\SpotifyTile;

use Spatie\Dashboard\Models\Tile;

class SpotifyStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName("spotifyTile");
    }

    public function setData(array $data): self
    {
        $this->tile->putData('spotifyData', $data);

        return $this;
    }

    public function getData(): array
    {
        return $this->tile->getData('key') ?? [];
    }

    public function getIsPlaying()
    {
        return $this->tile->getData('spotifyData.isPlaying');
    }

    public function getTrackName()
    {
        return $this->tile->getData('spotifyData.trackName');
    }

    public function getAlbumImage()
    {
        return $this->tile->getData('spotifyData.images.url');
    }

    public function getArtists()
    {
        return $this->tile->getData('spotifyData.trackArtist');
    }
}
