<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        return view('manager.checkout.index', ['checkouts' => Checkout::all()]);
    }
    public function create()
    {
        return view("manager.checkout.create");
    }
}
