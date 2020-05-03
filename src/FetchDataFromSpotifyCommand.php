<?php

namespace Ashbakernz\SpotifyTile;

use Illuminate\Console\Command;

class FetchDataFromSpotifyCommand extends Command
{
    protected $signature = 'dashboard:fetch-data-from-spotify-api';

    protected $description = 'Fetch data for tile';

    public function handle()
    {
        $this->info('Fetching spotify data...');

        $spotify = new Spotify(
            config('dashboard.tiles.spotify.client_id'),
            config('dashboard.tiles.spotify.secret'),
            config('dashboard.tiles.spotify.auth_code'),
        );

        $spotifyData = $spotify->getSpotfiyData();

        SpotifyStore::make()->setData($spotifyData);

        $this->info('All done!');
    }
}
