<?php

namespace App\Http\Controllers;

use App\Http\Requests\bookStore;
use App\Models\Book;
use App\Models\Menu;
use App\Models\Type;
use App\Models\StatusMenu;
use App\Models\Cart;
use App\Http\Requests\updateCart;
use App\Http\Requests\deleteCart;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        return view("/Customer/index");
    }

    public function bookForm()
    {
        return view("/Customer/booking/bookForm");
    }

    public function store(bookStore $request)
    {
        $book = new Book($request->all());
        $book->save();
        return redirect()->route('books.index')->with('success', 'Booking created successfully!');
    }

    public function orderForm()
    {
        $types = Type::all();
        return view("/Customer/order/orderForm", ['types' => $types]);
    }

    public function detailDish($id)
    {
        $dish = Menu::find($id);
        $typeName = Type::find(Menu::find($id)->type_id);
        $statusName = StatusMenu::find(Menu::find($id)->status_id);
        return view("/Customer/order/detailDish", ['dish' => $dish, 'typeName' => $typeName, 'statusName' => $statusName]);
    }

    public function addToCart($id)
    {
        $dish = Menu::find($id);

        if (!$dish) {
            return response()->json([
                'code' => 404,
                'message' => 'Dish not found',
            ], 404);
        }

        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $dish->name,
                'price' => $dish->price,
                'quantity' => 1,
                'image' => $dish->image,
            ];
        }
        session()->put('cart', $cart);

        return response()->json([
            'code' => 200,
            'message' => 'Dish added to cart successfully',
        ], 200);
    }

    public function showCart()
    {
        $carts = session()->get('cart');
        return view('Customer.order.viewCart', ['carts' => $carts]);
    }

    public function updateCart(updateCart $request)
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

    public function deleteCart(deleteCart $request)
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
    public function submitCart(Request $request)
    {
        $cart = new Cart($request->all());
        $cart->save();
        return redirect()->route('books.index')->with('success', 'Booking created successfully!');
    }
}
