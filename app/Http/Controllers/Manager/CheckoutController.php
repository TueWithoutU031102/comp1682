<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusCheckout;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
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
        if ($checkout->status === 'Transfer' && $data !== 'Transfer') {
            return to_route('manager.checkout.index')->with('error', 'This invoice has already been paid');
        }
        if ($checkout->transaction_id === null && $data === 'Transfer') {
            return to_route('manager.checkout.index')->with('error', 'This invoice cannot be paid by transfer');
        }

        $checkout->update(['status' => $data]);
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
