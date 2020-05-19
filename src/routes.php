<?php

use Ashbakernz\SpotifyTile\SpotifyController;

Route::get('/spotify/authorize', [SpotifyController::class, 'authorizeApplication'])->name('spotify.authorize');
Route::get('/spotify/callback', [SpotifyController::class, 'storeTokens'])->name('spotify.callback');
Route::get('/spotify/refresh', [SpotifyController::class, 'refreshTokens'])->name('spotify.refresh');
