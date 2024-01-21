<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\Menu;
use Carbon\Carbon;

class MenuController extends Controller
{
    //
    public function index()
    {
        $currentTime = Carbon::now();
        if ($currentTime->isBetween(Carbon::createFromTime(18, 0), Carbon::createFromTime(18, 40))) {
            $menus = Menu::all();
            return view(
                "customer.menu.index"
                // , ['types' => $types]
                ,
                ['menus' => $menus]
            );
        } else {
            $menus = Menu::where('type_id', '<>', 4)->get();
            return view("customer.menu.index", ['menus' => $menus]);
        }
    }

    public function show(Menu $menu)
    {
        return view("customer.menu.show", ['menu' => $menu]);
    }
}
