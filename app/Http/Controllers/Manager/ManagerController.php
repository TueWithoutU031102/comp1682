<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class ManagerController extends Controller
{
    //
    public function index()
    {
        $managerSuccess = session('managerSuccess');
        $totalSaled = Menu::all()->sum('saled');
        return view("manager.index", ['managerSuccess' => $managerSuccess]);
    }
}
