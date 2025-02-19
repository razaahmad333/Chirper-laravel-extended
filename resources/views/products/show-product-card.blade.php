<div class="mt-6 bg-white shadow-sm rounded-lg">

    <div class="p-6">
        <div class="flex justify-between items-center">

            <a href={{ route('products.show', $product) }} class="text-gray-800 font-semibold">
                {{ $product->name }}
            </a>
            <div>
                <span class="font-bold text-lg">
                    ${{ $product->price }}
                </span>
                <br>
            </div>
        </div>
        <div class="flex justify-between items-center mt-4">
            <div>
                <p class="text-red-500 text-xs font-bold">
                    {{ $product->category }}
                </p>
                <p class="text-xs text-gray-600">
                    {{ $product->description }}
                </p>
            </div>

            @include('products.add-to-cart-button', ['product' => $product])
        </div>

        @php
            $chirpCount = $product->chirps->count();
            $orderCount = $product->orderItems->count()
        @endphp
        <div class="flex">
        @if ($chirpCount > 0)
            <p class="text-xs text-gray-400 font-bold mt-2">
                {{ $chirpCount }} review{{ $chirpCount > 1 ? 's' : '' }}
            </p>
        @endif

        @if ($orderCount > 0)
            <p class="text-xs text-gray-400 font-bold mt-2 ml-2">
                {{ $orderCount }} order{{ $orderCount > 1 ? 's' : '' }} placed
            </p>
        @endif
    </div>
    </div>

</div>
