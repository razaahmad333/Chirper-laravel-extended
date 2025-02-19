<form onsubmit="addToCart(event, this)" data-url="{{ route('product.add-to-cart', $product) }}" method="post">
    @csrf
    <x-primary-button>Add to cart</x-primary-button>

    @php
        $inUserCart = $product->inUserCart(auth()->user());
    @endphp

    <div id="{{ $product->id }}-in-cart">
        @if ($inUserCart > 0)
            <p class="mt-1">
                {{ $inUserCart }} item already in cart
            </p>
        @endif
    </div>
</form>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    function addToCart(event, form) {
        event.preventDefault();
        const button = form.querySelector('button');
        button.disabled = true;

        console.log(button)
        let url = form.getAttribute('data-url');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

        fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                    "Content-Type": "application/json"
                },
            })
            .then(response => response.json())
            .then(data => {
                const cartCountContainer = document.getElementById('cartCount');
                const productInCartCountContainer = document.getElementById(url.split('/').pop() + '-in-cart');

                if (data.success && cartCountContainer) {
                    cartCountContainer.innerText = `${data.cartCount} Item in cart`;
                    button.disabled = false;
                    productInCartCountContainer.innerHTML = `<p class="mt-1">
                                                                ${data.productInCart} item already in cart
                                                            </p>`;
                } else {
                    alert("Failed to add product to cart");
                }
            })
            .catch(error => console.error("Error:", error));
    }
</script>
