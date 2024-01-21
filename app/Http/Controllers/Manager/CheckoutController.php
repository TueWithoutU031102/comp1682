<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusCheckout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Session;
use App\Models\Table;

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
        if ($checkout->status != "Pending") {
            $session = Session::where('mssv', $checkout->mssv)->first();
            if ($session) {
                $session->delete();
                session()->forget('customer.session');
                session()->forget('cart');
            }
        }
        return to_route('manager.checkout.index')->with('success', 'The invoice has been paid successfully!');
    }
    public function event()
    {
        $checkouts = Checkout::all();
        $tables = Table::all();
        $statuses = StatusCheckout::cases();
        return response()->json([
            'checkouts' => $checkouts,
            'tables' => $tables,
            'statuses' => $statuses,
        ]);
    }
}
