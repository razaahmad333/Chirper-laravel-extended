<x-app-layout>
    @php
        $cartItems = auth()->user()->cartItems;

        $products = [];

        $productQuantityMap = [];

        $total = 0;

        foreach ($cartItems as $cartItem) {
            $product = $cartItem->product;

            if (isset($productQuantityMap[$product->id])) {
                $productQuantityMap[$product->id]++;
            } else {
                $products[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                ];

                $productQuantityMap[$product->id] = 1;
            }
            $total += $product->price;
        }

        foreach ($products as $product) {
            $product['quantity'] = $productQuantityMap[$product['product_id']];
        }


    @endphp
    <div class="max-w-6xl mt-6 mx-auto p-6 sm:px-6 lg:px-8 bg-white rounded-lg">
        @if ($cartItems->count() === 0)
            <p>no items in cart</p>
        @else
            <table class="w-full mx-auto border border-gray-300  rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-2 text-left">Product Name</th>
                        <th class="px-4 py-2 text-center">Quantity</th>
                        <th class="px-4 py-2 text-center">Price</th>
                        <th class="px-4 py-2 text-right">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($products as $productDetails)
                        @php
                            [
                                'name' => $name,
                                'price' => $price,
                                'quantity' => $quantity,
                            ] = $productDetails;
                        @endphp
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $name }}</td>
                            <td class="px-4 py-3 text-center">{{ $quantity }}</td>
                            <td class="px-4 py-3 text-center">${{ number_format($price, 2) }}</td>
                            <td class="px-4 py-3 text-right font-semibold">${{ number_format($price * $quantity, 2) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr class="bg-gray-100 font-semibold">
                        <td colspan="3" class="px-4 py-3 text-right">Total</td>
                        <td class="px-4 py-3 text-right">${{ number_format($total, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <form action="{{ route('order.place') }}" method="post">
                @csrf
                <input type="hidden" name="products" value="{{ json_encode($products) }}">
                <input type="hidden" name="total" value="{{ $total }}">
                <x-primary-button class="mt-4">Place Order </x-primary-button>
            </form>

        @endif
    </div>

</x-app-layout>

<script></script>
