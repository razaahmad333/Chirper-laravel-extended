<x-app-layout>
    <x-slot name='header'>
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lets do some shopping
            </h2>

            @include('products.checkout-button')
          
        </div>
    </x-slot>
    <div class="max-w-2xl mx-auto">
        @foreach ($products as $product)
            @include('products.show-product-card', ['product' => $product])
        @endforeach
    </div>

</x-app-layout>
