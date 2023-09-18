<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Session;

class CheckinController extends Controller
{
    //
    public function index()
    {
        $table = Table::all();
        return view('Customer.checkin.index', ['table' => $table]);
    }

    public function storeSession(Table $table, Request $request)
    {
        $existingSession = Session::where('table_id', $table->id)->first();
        if (!$existingSession) {
            Session::create([
                'table_id' => $table->id
            ]);
            return to_route('customer.checkin.index', ['table' => $table]);
        } else {
            return view('Customer.checkin.notice');
        }
    }

    public function store(Request $request, Session $session, Table $table)
    {
        $existingSession = Session::where('table_id', $table->id)->first();
        if (!$existingSession) {
            $data = $request->validate([
                'name' => 'required',
                'phone' => 'required',
            ]);
            $session->fill($data)->save();
            return to_route('customer.index');
        } else {
            return view('Customer.checkin.notice');
        }
    }
}
