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
    public function store()
    {
        $data_cart = session()->get('cart', []);
        $session_id = session()->get('customer.session');
        $data_cart_count = count($data_cart);
        for ($i = 0; $i < $data_cart_count; $i++) {
            $menu_id = array_keys($data_cart)[$i];
            $quantity = $data_cart[$menu_id]['quantity'];

            $cartItem = new Cart();
            $cartItem->menu_id = $menu_id;
            $cartItem->quantity = $quantity;
            $cartItem->session_id = $session_id;
            $cartItem->save();
        }
        session()->forget('cart');
        return redirect()->route('customer.index');
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

    public function update($id, Request $request)
    {
        $cart = session()->get('cart', []);

        abort_if(empty($cart[$id]), 404, 'Dish not found in cart');

        $cart[$id]['quantity'] = $request->quantity;

        if ($request->quantity < 1) {
            unset($cart[$id]);
        }
        session()->put('cart', $cart);

        return ['success' => 'Dish removed from cart successfully'];
    }
}
