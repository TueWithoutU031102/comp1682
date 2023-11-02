<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusDish;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        $statuses = StatusDish::cases();
        $carts = Cart::all();
        return view('Manager.cart.index', ['carts' => $carts, 'statuses' => $statuses]);
    }

    public function update(Cart $cart, Request $request)
    {
        $data = [
            'status' => $request->status,
        ];
        $cart->update($data);
        return to_route('manager.cart.index')->with('success', 'Dish status edited successfully!');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return to_route('manager.cart.index')->with('success', 'Dish in cart deleted successfully!');
    }
}
