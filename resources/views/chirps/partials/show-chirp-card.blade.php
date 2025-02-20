<div class="p-6 flex space-x-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24"
        stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
    </svg>
    <div class="flex-1">
        <div class="flex justify-between items-center">
            <div>
                <a href="{{route('user.show', $chirp->user)}}" class="text-gray-800">{{ $chirp->user->name }}</a>

                <small class="ml-2 text-sm text-gray-600">{{ $chirp->created_at->format('j M Y, g:i a') }}</small>
                @unless ($chirp->created_at->eq($chirp->updated_at))
                    <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                @endunless
            </div>

            @if ($chirp->user->is(auth()->user()))
                <x-dropdown>
                    <x-slot name="trigger">
                        <button>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('chirps.edit', $chirp)">
                            {{ __('Edit') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('chirps.destroy', $chirp) }}">
                            @csrf
                            @method('delete')
                            <x-dropdown-link :href="route('chirps.destroy', $chirp)" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Delete') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
               
            @endif

            @if (!$chirp->user->is(auth()->user()))
                @include('user.partials.follow-button', ['user' => $chirp->user])
            @endif
        </div>
        <p class="mt-4 text-lg text-gray-900">{{ $chirp->message }}</p>

        <button class="like-button mt-3" onclick="toggleLike({{ $chirp->id }}, this)"
            data-chirp-id="{{ $chirp->id }}">
            ❤️ <span class="like-count">{{ $chirp->likes->count() }}</span>
        </button>
        <br>
        @if ($chirp->product)
            <p class="text-xs text-gray-400 font-bold mt-2">reviews the product
                <a href="{{ route('products.show', $chirp->product) }}">
                    {{ $chirp->product->name }}
                </a>
            </p>
        @endif
    </div>
</div>


<script>
    async function toggleLike(chirpId, button) {
        console.log({
            chirpId,
            button
        })
        button.disabled = true;
        const response = await fetch(`/chirps/${chirpId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
        const data = await response.json();
        button.querySelector('.like-count').innerText = data.likes_count;
        button.disabled = false;
    }
</script>
