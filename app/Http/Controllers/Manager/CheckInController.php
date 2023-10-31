<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Session;

class CheckInController extends Controller
{
    //
    public function index()
    {
        $session = Session::all();
        return view('Manager.checkin.index', ['session' => $session]);
    }
    public function show(Session $session)
    {

        return view("Manager.checkin.show", ['session' => $session]);
    }
    public function destroy(Session $session)
    {
        session()->pull('customer.session', [Session::where('table_id', $session->id)->first()]);
        $session->delete();
        return to_route('manager.checkin.index')->with('success', 'Session deleted successfully!');
    }
}
