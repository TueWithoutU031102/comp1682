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
        return view('admin.manage.index', ['users' => User::all()]);
    }

    public function create()
    {
        return view('admin.manage.create', ['roles' => Role::cases()]);
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

    public function edit(User $user)
    {
        return view('admin.manage.edit', [
            'user' => $user,
            'roles' => Role::cases()
        ]);
    }

    public function update(User $user, Request $request)
    {
        $data = $request->validate([
            'email' => [Rule::unique('users')->ignore($user->id)],
            'phone_number' => [Rule::unique('users')->ignore($user->id)],
        ]);
        $data['role'] = $request->has('role') ? $request->role : User::find($request['id'])->role;

        $data['password'] = !$request['password']
            ? User::find($request['id'])->password
            : Hash::make($request->validate([
                'password' => ['required', Password::min(8)->mixedCase()->letters()->numbers()->uncompromised()]
            ])['password']);
        $user->fill($data)->save();
        return to_route('admin.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'User deleted successfully!');

        return to_route('admin.index');
    }
}
