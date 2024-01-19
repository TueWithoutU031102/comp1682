<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart.index', ['cart' => $cart]);
    }
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

    public function add(Menu $menu, Request $request)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity');

        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity'] += $quantity;
        } else {
            $cart[$menu->id] = [
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => $quantity,
                'image' => $menu->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('customer.menu.index')->with('success', 'Món ăn đã được thêm vào giỏ hàng');
    }


    public function update($id, Request $request)
    {
        $cart = session()->get('cart', []);

        $request->validate([
            'quantity' => 'required|numeric|min:0',
        ]);

        abort_if(empty($cart[$id]), 404, 'Không có món ăn nào ở trong giỏ');

        $cart[$id]['quantity'] = $request->quantity;

        if ($request->quantity < 1) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        $message = $request->quantity < 1 ? 'Món ăn đã được xóa khỏi giỏ hàng' : 'Món ăn đã được cập nhật';

        return ['success' => $message];
    }
}
