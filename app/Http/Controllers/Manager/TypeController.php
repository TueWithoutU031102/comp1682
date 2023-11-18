<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view("manager.type.index", ['types' => $types]);
    }
    public function store(Request $request, Type $type)
    {
        $data = $request->validate(['name' => 'required']);
        $type->fill($data)->save();
        return back()->with('success', 'Type created successfully');
    }

    public function update(Request $request, Type $type)
    {
        $data = $request->validate(['name' => 'required']);
        $type->fill($data)->save();
        return back()->with('success', 'Type updated successfully');
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('manager.type.index')->with('success', 'Type deleted successfully');
    }
}
