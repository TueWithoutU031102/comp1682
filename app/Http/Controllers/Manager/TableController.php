<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    //
    public function index()
    {
        return view("manager.table.index", ['tables' => Table::all()]);
    }

    public function store(Request $request, Table $table)
    {
        //save form create table
        $data = $request->validate([
            'name' => 'required|string|min:3|max:10'
        ]);

        $table->fill($data)->save();

        return back()->with('success', "Table {$table->name} created");
    }

    public function edit(Table $table)
    {
        return view("manager.table.edit", ['table' => $table]);
    }

    public function update(Table $table, Request $request)
    {
        //update table
        $data = $request->validate(['name' => 'required|string|min:3|max:5']);
        $table->fill($data)->save();

        return back()->with('success', "Table {$table->name} updated");
    }
    public function destroy(Table $table)
    {
        //destroy table
        $table->delete();
        return to_route('manager.table.index')->with('success', "Table {$table->name} deleted");
    }

    public function event()
    {
        return Table::all();
    }
}
