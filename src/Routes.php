<?php

use Ashbakernz\SpotifyTile\Spotify;
use Ashbakernz\SpotifyTile\SpotifyController;

Route::get('/spotify/authorize', [SpotifyController::class, 'authorizeApplication']);
Route::get('/spotify/callback', [SpotifyController::class, 'storeTokens']);
Route::get('/spotify/refresh', [SpotifyController::class, 'refreshTokens']);
