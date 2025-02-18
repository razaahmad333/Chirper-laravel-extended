<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }} {{auth()->user()->name}}
                </div>
            </div>
        </div>
    </div>


    <div class="mb-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="mb-4 text-lg font-semibold">My Chirps</h2>

            @if ($myChirps->isEmpty())
                <p>You haven't created any chirps yet.</p>
            @else
                @foreach ($myChirps as $chirp)
                    @include('chirps.partials.show_chirp_card', ["chirp"=>$chirp])
                @endforeach
            @endif
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="mb-4 text-lg font-semibold">Liked Chirps ❤️</h2>

            @if ($likedChirps->isEmpty())
                <p>You haven't liked any chirps yet.</p>
            @else
                @foreach ($likedChirps as $chirp)
                    @include('chirps.partials.show_chirp_card', ["chirp"=>$chirp])
                @endforeach
            @endif
        </div>
    </div>

</x-app-layout>
