<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusCheckout;
use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    //
    public function index()
    {

        Menu::all()->pluck('saled');
        $transaction = Checkout::whereIn('status', [StatusCheckout::Cash, StatusCheckout::Transfer])
            ->where('created_at', '>=', now()->subMonth())
            ->get([
                DB::raw('*'),
                DB::raw('Date(created_at) as date'),
            ])->groupBy('date');
 
        return view("manager.index", [
            "menus" => Menu::all(),
            "transaction" => $transaction,
        ]);
    }
}
