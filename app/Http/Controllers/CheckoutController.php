<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //TODO: hướng dẫn em cách làm back end phần này
    public function index()
    {
        return view('manager.checkout.index', ['checkouts' => Checkout::all()]);
    }
    public function create()
    {
        return view("manager.checkout.create");
    }
    
}
