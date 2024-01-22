<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $notifications = Notification::all();
        return view("manager.notification.index", ['notifications' => $notifications]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Notification $notification, Request $request)
    {
        //
        $data = $request->all();
        $notification->fill($data)->save();
        session()->flash('managerSuccess', 'Notification created successfully!');
        return to_route("customer.index")->with('success', 'Vui lòng chờ, nhân viên sẽ hỗ trợ bạn sớm');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        //
        $notification->delete();
        return to_route('manager.notification.destroy')->with('success', 'Notification deleted successfully!');
    }

    public function event()
    {
        return Notification::with('session.table')->get();
    }
}
