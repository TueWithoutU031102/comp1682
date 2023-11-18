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
    public function create()
    {
        return view("manager.type.create");
    }
    public function store(Request $request, Type $type)
    {
        $data = $request->validate(['name' => 'required']);
        $type->fill($data)->save();
        return back()->with('success', 'Type created successfully');
    }

    /**
     * @deprecated version
     *
     * @param Type $type
     * @return void
     */
    public function edit(Type $type)
    {
        return view("manager.type.edit", ["type" => $type]);
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

    /**
     * @deprecated version
     *
     * @return void
     */
    public function event()
    {
        return Type::all();
    }
}
