<?php

namespace Ashbakernz\SpotifyTile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SpotifyController extends Controller
{
    public function authorizeApplication()
    {
        $scopes = [
            'user-read-private',
            'user-read-email',
            'user-read-playback-state',
            'user-read-currently-playing', // isn't this the only one necessary?
            'user-modify-playback-state',
            'user-read-playback-position',
            'user-read-recently-played',
            'app-remote-control',
            'streaming',
        ];

        $baseUrl = "https://accounts.spotify.com/authorize";
        $url = $baseUrl . '?' . http_build_query([
            'client_id' => config('dashboard.tiles.spotify.client_id'),
            'grant_type' => 'authorization_code',
            'response_type' => 'code',
            'scope' => implode(' ', $scopes),
            'redirect_uri' => route('spotify.callback'),
        ]);
        
        return redirect()->away($url);
    }

    public function storeTokens(Request $request)
    {
        if ($request->error == 'access_denied') {
            abort('403', 'access_denied');
        }

        $clientId = config('dashboard.tiles.spotify.client_id');
        $clientSecret = config('dashboard.tiles.spotify.secret');

        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
            ])->post(Spotify::SPOTIFY_API_TOKEN_URL, [
                'client_id' => $clientId,
                'grant_type' => 'authorization_code',
                'code' => $request->code,
                'redirect_uri' => route('spotify.callback'),
            ]);
        } catch (RequestException $e) {
            $status = $e->getCode();
            $message = $errorResponse->error_description;

            abort($status, $message);
        }

        $body = json_decode((string) $response->getBody());

        Cache::put('accessToken', $body->access_token);
        Cache::put('refreshToken', $body->refresh_token);

        return view('dashboard-spotify-tile::authorized');
    }

    public function refreshTokens()
    {
        $clientId = config('dashboard.tiles.spotify.client_id');
        $clientSecret = config('dashboard.tiles.spotify.secret');

        $accessToken = Cache::get('accessToken');
        $refreshToken = Cache::get('refreshToken');

        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
            ])->post(Spotify::SPOTIFY_API_TOKEN_URL, [
                'client_id' => $clientId,
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
                'redirect_uri' => route('spotify.callback'),
            ]);
        } catch (RequestException $e) {
            $status = $e->getCode();
            $message = $errorResponse->error_description;


            Log::error('Access token failed to update', $message);
            abort($status, $message);
        }

        $body = json_decode((string) $response->getBody());

        Cache::put('accessToken', $body->access_token);
        Log::info('Access token updated successfully');
    }
}
