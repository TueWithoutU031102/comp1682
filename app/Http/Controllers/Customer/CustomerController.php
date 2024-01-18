<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware(function (Request $request, Closure $next) {
            $table_id = Session::find(session()->get('customer.session'))->table->id;
            $user_name = Session::find(session()->get('customer.session'))->name;
            $session_id = session()->get('customer.session');
            $bill = Cart::where('session_id', $session_id)->get();

            view()->share('table_id', $table_id);
            view()->share('user_name', $user_name);
            view()->share('session_id', $session_id);
            view()->share('bill', $bill);

            return $next($request);
        });
    }


    public function index()
    {
        return view("customer.index");
    }

    public function cartData()
    {
        return view("customer.cart-data");
    }

}
