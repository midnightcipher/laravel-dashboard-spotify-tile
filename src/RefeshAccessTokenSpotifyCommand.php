<?php

namespace Ashbakernz\SpotifyTile;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RefeshAccessTokenSpotifyCommand extends Command
{
    protected $signature = 'dashboard:refresh-access-token-spotify';

    protected $description = 'Refresh spotify  access token';

    public function handle()
    {
        $this->info('Refreshing access token...');

        Http::get(config('app.url') . '/spotify/refresh');

        $this->info('Refresh complete.');
    }
}
