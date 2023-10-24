<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
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
        $roles = Role::cases();
        return view('admin.manage.create', ['roles' => $roles]);
    }

    public function store(User $user, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'phone' => 'required|required|digits:10|starts_with:0|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->uncompromised(),
            ],
        ]);
        $user->fill($data)->save();
        return to_route('admin.index');
    }

    public function show(User $user)
    {
        return view('admin.manage.show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        $roles = Role::cases();
        return view('admin.manage.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(User $user, Request $request)
    {
        $data = $request->validate([
            'email' => [Rule::unique('users')->ignore($request->id)],
            'phone_number' => [Rule::unique('users')->ignore($request->id)],
        ]);
        if (!$request['password']) {
            $data['password'] = User::find($request['id'])->password;
        } else $data['password'] = Hash::make($request->password);
        $user->fill($data)->save();
        return to_route('admin.index');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return to_route('admin.index');
    }
}
