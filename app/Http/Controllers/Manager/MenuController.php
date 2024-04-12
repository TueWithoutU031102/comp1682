<?php

namespace App\Http\Controllers\Manager;

use App\Enums\StatusMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Menu;
use App\Models\Type;
use Illuminate\Validation\Rules\Enum;

class MenuController extends Controller
{
    public function index()
    {
        $types = Type::with('menus')->get();
        return view("manager.menu.index", ['types' => $types]);
    }

    public function create()
    {
        $listTypes = Type::all();
        $listStatus = StatusMenu::cases();
        return view("manager.menu.create", ['types' => $listTypes, 'statuses' => $listStatus]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type_id' => 'required',
            'quantity'=>'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'image' => 'required',
            'status' => ['required', new Enum(StatusMenu::class)],
        ]);

        $imagePath = $this->saveImage($request->file('image'));
        Menu::create(array_merge($data, ['image' => $imagePath]));

        return redirect()->route('manager.menu.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        $types = Type::all();
        $statuses = StatusMenu::cases();
        return view("manager.menu.edit", ["menu" => $menu, "types" => $types, "statuses" => $statuses]);
    }

    public function update(Menu $menu, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type_id' => 'required',
            'quantity'=>'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $menu->removeImage();
            $data['image'] = $this->saveImage($request->file('image'));
        } else
            $data['image'] = $menu->image;

        $data['status'] = $request->status ? $request->status : $menu->status;

        $menu->fill($data)->save();
        return redirect()->route('manager.menu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->removeImage();
        $menu->delete();
        return back()->with('success', 'Menu deleted successfully.');
    }

    protected function saveImage(UploadedFile $file)
    {
        $name = uniqid("menu_") . "." . $file->getClientOriginalExtension();
        move_uploaded_file($file->getPathname(), public_path('images/' . $name));
        return "images/" . $name;
    }
}
