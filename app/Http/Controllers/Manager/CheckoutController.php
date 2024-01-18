<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusCheckout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        $checkouts = Checkout::all();
        $statuses = StatusCheckout::cases();
        return view('manager.checkout.index', ['checkouts' => $checkouts, 'statuses' => $statuses]);
    }

    public function update(Request $request, Checkout $checkout)
    {
        $data = $request->status;

        $checkout->update(['status' => $data]);
        return to_route('manager.checkout.index')->with('success', 'The invoice has been paid successfully!');
    }
}
