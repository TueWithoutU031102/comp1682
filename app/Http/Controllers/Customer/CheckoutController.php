<?php

namespace App\Http\Controllers\Customer;

use App\Enums\StatusCheckout;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\Session;
use App\Payment\VNPay;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Show checkout page.
     *
     */
    public function show()
    {
        $session = Session::find(session()->get('customer.session'));

        return view('customer.checkout.process', [

        ]);
    }

    public function pay(VNPay $payment, Checkout $checkout, Request $request)
    {
        $session = Session::find(session()->get('customer.session'));
        $before = Checkout::where('table_id', $session->table_id)->where('status', StatusCheckout::Pending)->first();

        if ($before) {
            $before->forceFill(['status' => StatusCheckout::Canceled])->save();
        }

        $items = Cart::where('session_id', $session->id)->with('menu')->get();

        if ($items->count() == 0) {
            return to_route('customer.index'); // card is empty then abort checkout
        }

        $checkout->forceFill([
            'table_id' => $session->table_id,
            'total' => $items->sum(fn($item) => $item->total()),
        ])->save();

        $checkout->carts()->saveMany($items);

        $url = $payment->create(
            $checkout->id,
            $checkout->total,
            $request->ip(),
            "Thanh toan don hang {$checkout->id}",
            route('vnpay.verify')
        );

        return redirect($url);
    }

    public function verify(VNPay $payment)
    {
        $payload = $payment->read();

        if (!$payload) {
            return; // Redirect to invalid page
        }

        $process = Checkout::find($payload->ref);

        if (!$process || $process->status !== StatusCheckout::Pending) {
            return; // Redirect to invalid page
        }

        if (!$payload->success) {
            $process->forceFill(['status' => StatusCheckout::Canceled])->save();
            return; // Redirect failed payment page
        }

        $process->forceFill([
            'status' => StatusCheckout::Transfer,
            'transaction_id' => $payload->transaction_id,
        ])->save();

        // TODO: invalid the session and cart

        return; // redirect to success page
    }
}
