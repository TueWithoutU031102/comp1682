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
    public function store(Notification $notification)
    {
        //
        $notification->save();
        return to_route("customer.index")->with('success', 'Notification created successfully!');
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
        return Notification::all();
    }
}