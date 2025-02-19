<x-app-layout>

    <div class="max-w-6xl mt-6 mx-auto p-6 sm:px-6 lg:px-8 bg-white rounded-lg">
        <h2>
            Order #{{ $order->id }}
        </h2>

        <p>{{ $order->status }}
        </p>
    </div>
</x-app-layout>
