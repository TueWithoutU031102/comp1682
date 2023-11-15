<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusDish;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Session;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        $statuses = StatusDish::cases();
        $carts = Cart::all();
        return view('Manager.order.index', ['carts' => $carts, 'statuses' => $statuses]);
    }

    public function update(Cart $cart, Request $request)
    {
        $data = [
            'status' => $request->status,
        ];
        $cart->update($data);
        return to_route('manager.order.index')->with('success', 'Dish status edited successfully!');
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return to_route('manager.order.index')->with('success', 'Dish in cart deleted successfully!');
    }
    public function event()
    {
        $carts = Cart::all();
        $menus = Menu::all();
        $sessions = Session::all();
        $tables = Table::all();
        return response()->json([
            'carts' => $carts,
            'menus' => $menus,
            'sessions' => $sessions,
            'tables' => $tables,
        ]);
    }
}
