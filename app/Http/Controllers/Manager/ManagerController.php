<?php

namespace App\Http\Controllers;

use App\Http\Requests\editMenu;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\editType;
use App\Http\Requests\formMenu;
use App\Http\Requests\formType;
use App\Models\Book;
use App\Models\Menu;
use App\Models\Type;
use App\Models\StatusMenu;

class ManagerController extends Controller
{
    //
    public function index()
    {
        return view("manager.index");
    }
    // public function type()
    // {
    //     $types = Type::all();
    //     return view("/Manager/type/indexType", ['types' => $types]);
    // }
    // public function createFormType()
    // {
    //     return view("/Manager/type/typeForm");
    // }
    // public function createType(formType $request)
    // {
    //     $type = new Type($request->all());
    //     $type->save();
    //     return redirect()->route('indexType')->with('success', 'Type created successfully!');
    // }
    // public function editFormType($id)
    // {
    //     $type = Type::find($id);
    //     return view("Manager/type/editType", ["type" => $type]);
    // }
    // public function editType(editType $request)
    // {
    //     $input = $request->all();
    //     Type::find($request->id)->update($input);
    //     return redirect()->route('indexType')->with('success', 'Type edited successfully!');
    // }
    // public function deleteType(Type $type)
    // {
    //     $type->delete();
    //     return redirect('/manager/type/indexType')->with('success', 'Type deleted successfully');
    // }
}
