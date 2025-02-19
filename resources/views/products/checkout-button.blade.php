@php
    $cartItemCount = auth()->user()->cartItems->count();
@endphp

<a href={{ route('checkout') }} id='cartCount'>
    @if ($cartItemCount > 0)
        {{ $cartItemCount }} Item in cart
    @else
        No Items in cart
    @endif
</a>
