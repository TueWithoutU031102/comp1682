<?php

namespace App\Http\Controllers\Customer;

use App\Models\VNPay;
use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Cart;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $table_id = Session::find(session()->get('customer.session'))->table->id;
        $user_name = Session::find(session()->get('customer.session'))->name;
        $session_id = session()->get('customer.session');
        $bill = Cart::where('session_id', $session_id)->get();
        return view("customer.index", ["table_id" => $table_id, "user_name" => $user_name, "session_id" => $session_id, "bill" => $bill]);
    }

}
