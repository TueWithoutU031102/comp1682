<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Session;

class CheckinController extends Controller
{
    //
    public function index(Table $table)
    {
        return view('Customer.checkin.index', ['table' => $table]);
    }

    public function create(Table $table, Request $request)
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

    public function store(Table $table, Request $request)
    {
        $existingSession = Session::where('table_id', $table->id)->first();
        if ($existingSession) {
            $data = $request->validate([
                'name' => 'required',
                'phone' => 'required|required|digits:10|starts_with:0',
                'table_id' => 'required',
            ]);
            $existingSession->fill($data)->save();
            return to_route('customer.index');
        }
        else return back();
    }
}
