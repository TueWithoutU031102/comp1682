<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Menu;
use App\Http\Requests\deleteCart;
use App\Http\Requests\updateCart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = new Cart($request->all());
        $cart->save();
        return redirect()->route('customers.index');
    }
    public function add(Menu $menu)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity']++;
        } else {
            $cart[$menu->id] = [
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => 1,
                'image' => $menu->image,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Dish added to cart successfully');
    }

    public function show()
    {
        $carts = session()->get('cart');
        return view('Customer.order.viewCart', ['carts' => $carts]);
    }

    public function update(updateCart $request)
    {

        $id = $request->input('id');
        $quantity = $request->input('quantity');
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
            $carts = session()->get('cart');
            $cartComponents = view('Customer.order.components.cart_component', ['carts' => $carts])->render();
            return response()->json([
                'cart_component' => $cartComponents,
                'code' => 200,
                'message' => 'Cart updated successfully',
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Dish not found in cart',
            ], 404);
        }
    }

    public function remove(deleteCart $request)
    {
        $id = $request->input('id');

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            $carts = session()->get('cart');
            $cartComponents = view('Customer.order.components.cart_component', ['carts' => $carts])->render();
            return response()->json([
                'cart_component' => $cartComponents,
                'code' => 200,
                'message' => 'Dish removed from cart successfully',
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Dish not found in cart',
            ], 404);
        }
    }
}