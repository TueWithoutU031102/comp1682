<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Type;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function index()
    {
        $menu = Menu::all();
        $types = Type::all();
        return view("public.index", ["menu" => $menu, "types" => $types]);
    }
}
