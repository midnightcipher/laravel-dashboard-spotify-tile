<x-dashboard-tile :position="$position">
    <div wire:poll.{{ $refreshIntervalInSeconds }}s
         class="grid gap-2 justify-items-center h-full text-center"
         style="grid-template-rows: auto 1fr auto;"
    >
        @if($isPlaying)
                <h1 class="font-medium text-dimmed text-sm uppercase tracking-wide">Currently Playing</h1>
                <div class=" flex items-center justify-center">
                    <img class="w-32 h-32 rounded" src="{{ $albumImage }}" alt="Album Pic">
                </div>
                <div class="self-center font-bold text-xl tracking-wide leading-none">
                    {{ $trackName }}
                </div>
                <div>
                    <div class="flex w-full justify-center space-x-4 items-center">
                        <span class="text-xs text-dimmed">
                            {{ implode(', ', array_column($artists ?? [], 'name')) }}
                        </span>
                    </div>
                </div>
        @else
            @if(!cache()->has('refreshToken'))
                <a class="btn border rounded px-4 py-1 border-white hover:opacity-75" href="{{route('spotify.authorize') }}" target="_blank">Authorize</a>
            @endif
            <div class="flex">
                <div class="w-full pt-8 bt-0">
                    <div class="flex justify-center text-2xl text-grey-darkest font-medium">
                        <h2>Spotify is not currently playing :(</h2>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-dashboard-tile>
