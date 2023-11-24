<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Menu;

class ManagerController extends Controller
{
    //
    public function index()
    {

        Menu::all()->pluck('saled');


        return view("manager.index", [
            "menus" => Menu::all()
        ]);
    }
}
