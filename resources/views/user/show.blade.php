<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex items-center ">
                <div class="p-6 text-gray-900">
                    {{ $user->name }}
                </div>

                @include('user.partials.follow-button', ["user"=>$user])
            </div>
        </div>
    </div>


    <div class="mb-4 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="mb-4 text-lg font-semibold">Chirps</h2>

            @if ($user->chirps->isEmpty())
                <p>User haven't created any chirps yet.</p>
            @else
                @foreach ($user->chirps as $chirp)
                    @include('chirps.partials.show-chirp-card', ['chirp' => $chirp])
                @endforeach
            @endif
        </div>
    </div>

    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="mb-4 text-lg font-semibold">Liked Chirps ❤️</h2>

            @if ($user->likedChirps->isEmpty())
                <p>User haven't liked any chirps yet.</p>
            @else
                @foreach ($user->likedChirps as $chirp)
                    @include('chirps.partials.show-chirp-card', ['chirp' => $chirp])
                @endforeach
            @endif
        </div>
    </div>

</x-app-layout>
