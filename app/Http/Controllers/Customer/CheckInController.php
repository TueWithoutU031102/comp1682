<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Session;

class CheckinController extends Controller
{
    //

    public function create(Table $table)
    {
        if (session()->has('customer.session'))
            return to_route('customer.index');

        $existingSession = Session::where('table_id', $table->id)->first();
        if ($existingSession) {
            return to_route('forbidden');
        }
        return view('customer.checkin.index', ['table' => $table]);
    }

    public function store(Table $table, Request $request)
    {
        $existingSession = Session::where('table_id', $table->id)->first();
        if (!$existingSession) {
            $data = $request->validate([
                'name' => 'required',
                'phone' => 'required|required|digits:10|starts_with:0',
                'table_id' => 'required',
            ]);
            $session = new Session($data);
            $session->save();
            session()->put('customer.session', $session->id);
            return to_route('customer.index');
        }

        return to_route('forbidden');
    }
}
