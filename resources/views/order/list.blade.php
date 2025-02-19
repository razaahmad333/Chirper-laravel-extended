<x-app-layout>

    @php
        $myOrders = auth()->user()->orders;
    @endphp

    <div class="max-w-6xl mt-6 mx-auto p-6 sm:px-6 lg:px-8 bg-white rounded-lg">
        <h2>
            Orders
        </h2>

        @if ($myOrders->count() > 0)
            @foreach ($myOrders as $order)
                <div class="mt-4">
                    <h2 class="font-bold text-gray-600">Order #{{ $order->id }}</h2>
                    <p>
                        <b class="text-gray-600">
                            Amount
                        </b>: {{ $order->amount }}
                    </p>
                    <p>
                        <b class="text-gray-600">
                            Status
                        </b>: {{$order->status}}
                    </p>
                </div>
            @endforeach
        @else
            <p>
                no orders found!
            </p>
        @endif

    </div>
</x-app-layout>
