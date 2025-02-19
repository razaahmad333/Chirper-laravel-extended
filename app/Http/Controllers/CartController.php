<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request, Product $product): JsonResponse
    {
        $user = $request->user();
        $user->cartItems()->create(["product_id" => $product->id]);

        return response()->json([
            'success' => true,
            "cartCount" => $user->cartItems->count(),
            'productInCart' => $product->inUserCart($user),
        ]);
    }
}
