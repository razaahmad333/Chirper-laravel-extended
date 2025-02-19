<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{

    public function checkout(Request $request): View
    {
        return view('order.checkout');
    }

    public function show(Request $request, Order $order): View
    {
        return view('order.show', ['order' => $order]);
    }

    public function list(Request $request): View
    {
        return view('order.list');
    }

    public function placeOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "products" => "string|required",
            "total" => "string|required",
        ]);

        $user = $request->user();

        $order = Order::create([
            "user_id" => $user->id,
            "amount" => (float)$validated['total'],
            "status" => "PLACED",
        ]);

        $products = json_decode($validated['products'], true);
        
        $order->orderItems()->createMany($products);

        $user->cartItems()->whereIn('product_id', array_column($products, 'product_id'))->delete();

        return redirect(route('order.show', ["order" => $order]));
    }
}
