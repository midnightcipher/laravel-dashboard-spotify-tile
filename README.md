# A tile to display infomation from Spotify

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ashbakernz/laravel-dashboard-spotify-tile.svg?style=flat-square)](https://packagist.org/packages/ashbakernz/laravel-dashboard-spotify-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ashbakernz/laravel-dashboard-spotify-tile/run-tests?label=tests)](https://github.com/ashbakernz/laravel-dashboard-spotify-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/ashbakernz/laravel-dashboard-spotify-tile.svg?style=flat-square)](https://packagist.org/packages/ashbakernz/laravel-dashboard-spotify-tile)

This tile displays now playing infomation from spotify.

This tile can be used on [the Laravel Dashboard]https://docs.spatie.be/laravel-dashboard).

## Installation

You can install the package via composer:

```bash
composer require ashbakernz/laravel-dashboard-spotify-tile
```

In the dashboard config file, you must add this configuration in the tiles key.

```php
    'spotify' => [
        'spotify_client_id' => env('SPOTIFY_CLIENT_ID'),
        'spotify_client_secret' => env('SPOTIFY_CLIENT_SECRET'),
    ]
```
#### Getting `SPOTIFY_CLIENT_ID` and `SPOTIFY_CLIENT_SECRET`
Sign up at https://developer.spotify.com/dashboard and register your application to obtain `SPOTIFY_CLIENT_ID` and `SPOTIFY_CLIENT_SECRET`.

Once you have setup your application please go to the [spotify dashboard](https://developer.spotify.com/dashboard/applications), select your application and click "EDIT SETTINGS" in the top right. You will then need to add your project environment URLs to the "Redirect URIs
" section and then hit save. This will allow us to authenticate correctly in the next step.


#### Getting `SPOTIFY_AUTHORIZATION_CODE`
Due to the spotify api restriction getting the authorization code is a little bit tedious.  
To get the `SPOTIFY_AUTHORIZATION_CODE` please use the to following URL, make sure to replace the `SPOTIFY_CLIENT_ID` and `YOUR_REDIRECT_URI` (this should be the same as the one in the settings for the application in the spotify dashboard) with your own. Then go to the link your browser and authenicate your account.
```txt
https://accounts.spotify.com/authorize?client_id=SPOTIFY_CLIENT_ID&response_type=code&redirect_uri=YOUR_REDIRECT_URI&grant_type=authorization_code&scope=user-read-private user-read-email streaming app-remote-control user-read-playback-state user-read-currently-playing 
user-modify-playback-state user-read-playback-position user-read-recently-played
```
Once you have gone to this URL you will see in the URL bar `?code=YOUR_AUTH_CODE` copy just the code into the `.env` or `dashboard.php` config file.

## Usage

In your dashboard view you use the `livewire:spotify-tile` component.

```html
<x-dashboard>
    <livewire:spotify-tile position="a1:a1" />
</x-dashboard>
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email :author_email instead of using the issue tracker.

## Credits
- [Ash Baker](https://github.com/ashbakernz)
- [Spatie](https://github.com/spatie/) for [laravel-dashboard-skeleton-tile](https://github.com/spatie/laravel-dashboard-skeleton-tile)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
