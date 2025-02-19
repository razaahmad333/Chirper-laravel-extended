<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Do you like {{ $product->name }}?
            </h2>

            @include('products.checkout-button')

        </div>
    </x-slot>
    <div class="max-w-2xl mx-auto">
        @include('products.show-product-card', ['product' => $product])

        <div class="mt-6">
            <form method="POST" action="{{ route('chirps.store') }}">
                @csrf
                <textarea name="message" placeholder="{{ __('What\'s on your mind for the product?') }}"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('message') }}</textarea>
                <x-input-error :messages="$errors->get('message')" class="mt-2" />
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
            </form>
        </div>

        <div class="mt-6  bg-white rounded-lg">
            @foreach ($product->chirps as $chirp)
                @include('chirps.partials.show-chirp-card', ['chirp' => $chirp])
            @endforeach
        </div>
    </div>

</x-app-layout>
