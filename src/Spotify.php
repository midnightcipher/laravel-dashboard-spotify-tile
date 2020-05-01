<?php

namespace Ashbakernz\SpotifyTile;

use Illuminate\Support\Facades\Http;

class Spotify
{
    private const SPOTIFY_API_TOKEN_URL = 'https://accounts.spotify.com/api/token';

    private $clientId;
    private $clientSecret;
    private $authCode;
    private $redirect_uri;
    private $scopes = 'user-read-private user-read-email streaming app-remote-control user-read-playback-state user-read-currently-playing 
user-modify-playback-state user-read-playback-position user-read-recently-played';

    private $accessToken;
    private $refreshToken;

    public function __construct($clientId, $clientSecret, $authCode)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->authCode = $authCode;
        $this->redirect_uri = config('app.url');
    }

    private function generateAccessToken()
    {
        try {
            $response = Http::asForm()->withHeaders([
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
            ])->post(self::SPOTIFY_API_TOKEN_URL, [
                'grant_type' => 'client_credentials',
            ]);
        } catch (RequestException $e) {
            $status = $e->getCode();
            $message = $errorResponse->error_description;

            abort($status, $message);
        }

        $body = json_decode((string) $response->getBody());

        $this->accessToken = $body->access_token;
    }

    public function generateAccessTokenFromAuthCode()
    {
        try {
            $response = Http::asForm()->withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
            ])->post(self::SPOTIFY_API_TOKEN_URL, [
                'grant_type' => 'authorization_code',
                'code' => $this->authCode,
                'redirect_uri' => $this->redirect_uri,
            ]);
        } catch (RequestException $e) {
            $status = $e->getCode();
            $message = $errorResponse->error_description;

            abort($status, $message);
        }

        $body = json_decode((string) $response->getBody());
        dd($body);
        $this->accessToken = $body->access_token;
    }

    public function generateAuthCode()
    {
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
        ])->post(self::SPOTIFY_API_TOKEN_URL, [
            'grant_type' => 'authorization_code',
            'code' => $this->authCode,
            'redirect_uri' => $this->redirect_uri,
        ]);
    }

    public function getSpotfiyData(): array
    {
        if (! $this->accessToken) {
            $this->generateAccessTokenFromAuthCode();
        }

//        $this->getCurrentlyPlaying();

        return [
            $this->accessToken,
        ];
    }

    private function getCurrentlyPlaying()
    {
        $endpoint = 'https://api.spotify.com/v1/me/player/currently-playing';

        $response = Http::withToken($this->accessToken)->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->get($endpoint)->json();
    }
}
