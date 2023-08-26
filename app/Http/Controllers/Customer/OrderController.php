<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    // public function addToCart($id)
    // {
    //     $dish = Menu::find($id);

    //     if (!$dish) {
    //         return response()->json([
    //             'code' => 404,
    //             'message' => 'Dish not found',
    //         ], 404);
    //     }

    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity']++;
    //     } else {
    //         $cart[$id] = [
    //             'name' => $dish->name,
    //             'price' => $dish->price,
    //             'quantity' => 1,
    //             'image' => $dish->image,
    //         ];
    //     }
    //     session()->put('cart', $cart);

    //     return response()->json([
    //         'code' => 200,
    //         'message' => 'Dish added to cart successfully',
    //     ], 200);
    // }

    // public function showCart()
    // {
    //     $carts = session()->get('cart');
    //     return view('Customer.order.viewCart', ['carts' => $carts]);
    // }

    // public function updateCart(updateCart $request)
    // {

    //     $id = $request->input('id');
    //     $quantity = $request->input('quantity');

    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$id])) {
    //         $cart[$id]['quantity'] = $quantity;
    //         session()->put('cart', $cart);
    //         $carts = session()->get('cart');
    //         $cartComponents = view('Customer.order.components.cart_component', ['carts' => $carts])->render();
    //         return response()->json([
    //             'cart_component' => $cartComponents,
    //             'code' => 200,
    //             'message' => 'Cart updated successfully',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'code' => 404,
    //             'message' => 'Dish not found in cart',
    //         ], 404);
    //     }
    // }

    // public function deleteCart(deleteCart $request)
    // {

    //     $id = $request->input('id');

    //     $cart = session()->get('cart', []);

    //     if (isset($cart[$id])) {
    //         unset($cart[$id]);
    //         session()->put('cart', $cart);
    //         $carts = session()->get('cart');
    //         $cartComponents = view('Customer.order.components.cart_component', ['carts' => $carts])->render();
    //         return response()->json([
    //             'cart_component' => $cartComponents,
    //             'code' => 200,
    //             'message' => 'Dish removed from cart successfully',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'code' => 404,
    //             'message' => 'Dish not found in cart',
    //         ], 404);
    //     }
    // }
    // public function submitCart(Request $request)
    // {
    //     $cart = new Cart($request->all());
    //     $cart->save();
    //     return redirect()->route('customers.index');
    // }
}
