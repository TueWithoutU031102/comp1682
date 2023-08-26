<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Menu;
use App\Models\StatusMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function index()
    {
        $types = Type::all();
        return view("customer.menu.index", ['types' => $types]);
    }

    public function show(Menu $menu)
    {
        return view("customer.menu.show", ['menu' => $menu]);
    }
}
