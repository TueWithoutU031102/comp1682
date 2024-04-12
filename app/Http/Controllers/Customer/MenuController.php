<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Menu;
use Illuminate\Cache\RateLimiting\Limit;

class MenuController extends Controller
{
    //
    public function index()
    {
        $types = Type::all();
        $bestSeller = Menu::limit(5)->orderBy('saled')->get();
        return view("customer.menu.index", ['types' => $types,'bestSeller' => $bestSeller]);
    }

    public function show(Menu $menu)
    {
        return view("customer.menu.show", ['menu' => $menu]);
    }
}
