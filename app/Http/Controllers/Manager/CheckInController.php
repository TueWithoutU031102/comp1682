<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Table;

class CheckInController extends Controller
{
    //
    public function index()
    {
        $session = Session::all();
        return view('manager.checkin.index', ['session' => $session]);
    }
    
    /**
     * @deprecated
     *
     */
    public function show(Session $session)
    {
        return view("manager.checkin.show", ['session' => $session]);
    }

    public function destroy(Session $session)
    {
        session()->pull('customer.session', [Session::where('table_id', $session->id)->first()]);
        $session->delete();

        return back()->with('success', "Session {$session->name} deleted");
    }

    public function event()
    {
        $sessions = Session::all();
        $tables = Table::all();
        return response()->json([
            'sessions' => $sessions,
            'tables' => $tables,
        ]);
    }
}
