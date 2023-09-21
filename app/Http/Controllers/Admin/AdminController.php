<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Role;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.manage.index', ['users' => $users]);
    }

    public function create()
    {
        $role = Role::cases();
        
    }
}
