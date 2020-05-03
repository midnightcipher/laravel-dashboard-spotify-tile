# A tile to display infomation from Spotify

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ashbakernz/laravel-dashboard-spotify-tile.svg?style=flat-square)](https://packagist.org/packages/ashbakernz/laravel-dashboard-spotify-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ashbakernz/laravel-dashboard-spotify-tile/run-tests?label=tests)](https://github.com/ashbakernz/laravel-dashboard-spotify-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/ashbakernz/laravel-dashboard-spotify-tile.svg?style=flat-square)](https://packagist.org/packages/ashbakernz/laravel-dashboard-spotify-tile)

This tile displays "now playing" infomation from spotify.

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

![laravel dashboard spotify tile](https://ashbaker.dev/assets/packages/laravel-dashboard-spotfiy-tile.png)


## Installation

You can install the package via composer:

```bash
composer require ashbakernz/laravel-dashboard-spotify-tile
```

In the dashboard config file, you must add this configuration in the tiles key.

```php
    'spotify' => [
        'client_id' => env('SPOTIFY_CLIENT_ID'),
        'secret' => env('SPOTIFY_SECRET'),
        'refresh_interval_in_seconds' => 60,
    ]
```
#### Getting `SPOTIFY_CLIENT_ID` and `SPOTIFY_CLIENT_SECRET`
Sign up at https://developer.spotify.com/dashboard and register your application to obtain `SPOTIFY_CLIENT_ID` and `SPOTIFY_CLIENT_SECRET`.

Once you have setup your application please go to the [spotify dashboard](https://developer.spotify.com/dashboard/applications), select your application and click "EDIT SETTINGS" in the top right. You will then need to add the following urls based on your environments to the "Redirect URIs
" section and then hit save. This will allow us to authenticate correctly in the next step.

Redirect URI example:
```bash
https://yourdomain.com/spotify/callback
```

Once this is complete please head to the `/spotify/authorize` route on your dashboard in a browser and this will allow you to authenicate your spotify account. 

Once authenicated setup is complete and you may use.

## Bugs
If the tile is displaying incorrectly please head to the `/spotify/refresh` route in a browser to refresh your spotify access token manually. (a is already setup command is setup to do this every 30mins)

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
