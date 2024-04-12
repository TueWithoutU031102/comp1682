<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusDish;
use App\Enums\StatusMenu;
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
        return view('manager.order.index', ['carts' => $carts, 'statuses' => $statuses]);
    }

    public function update(Cart $cart, Request $request)
    {
        $data = [
            'status' => $request->status,
        ];
        if ($cart['status'] === 'Completed' && $data['status'] !== 'Completed') {
            $menu = Menu::find($cart->menu_id);
            if (is_int($menu->saled) && $menu->saled >= $cart->quantity) {
                $menu->update(['saled' => $menu->saled - $cart->quantity]);
                $menu->update(['quantity' => $menu->quantity + $cart->quantity]);
            }
        } else if ($cart['status'] !== 'Completed' && $data['status'] === 'Completed') {
            $menu = Menu::find($cart->menu_id);
            if (is_int($menu->saled)) {
                $menu->increment('saled', $cart->quantity);
                $menu->decrement('quantity', $cart->quantity);
            }
        }
        if($menu->quantity === 0)
            $menu->update(['status' => StatusMenu::Unavailable->value]);
        $cart->update($data);

        return to_route('manager.order.index')->with('success', 'Dish in cart updated successfully!');
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
