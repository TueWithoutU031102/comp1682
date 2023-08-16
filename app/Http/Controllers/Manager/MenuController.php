<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\Menu;
use App\Models\Type;
use App\Models\StatusMenu;

class MenuController extends Controller
{
    //
    public function index()
    {
        $menus = Menu::all();
        return view("manager.menu.index", ['menus' => $menus]);
    }
    public function create()
    {
        $listTypes = Type::all();
        $listStatus = StatusMenu::all();
        return view("manager.menu.create", ['listTypes' => $listTypes, 'listStatus' => $listStatus]);
    }
    public function store(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'name' => 'required',
            'type_id' => 'required',
            'status_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
        ]);
        $imagePath = $this->saveImage($request->file('image'));
        Menu::create(array_merge($data, ['image' => $imagePath]));
        return to_route("manager.menu.index")->with('success', 'Dish created successfully!');
    }

    public function show(Menu $menu, Type $type)
    {
        //$type = Type::find($menu->type_id);
        return view("manager.menu.show", ['menu' => $menu, 'type' => $type]);
    }
    public function edit(Menu $menu)
    {
        $types = Type::all();
        $statuses = StatusMenu::all();
        return view("manager.menu.edit", ["menu" => $menu, "types" => $types, "statuses" => $statuses]);
    }
    public function update(Menu $menu, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type_id' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $menu->removeImage();
            $request['image'] = $this->saveImage($request->file('image'));
        } else
            $request['image'] = $menu->image;
        $menu->fill($data)->save();
        return to_route('manager.menu.index')->with('success', 'Dish edited successfully!');
    }
    public function destroy(Menu $menu)
    {
        $menu->removeImage();
        $menu->delete();
        return to_route('manager.menu.index')->with('success', 'Dish deleted successfully!');
    }
    protected function saveImage(UploadedFile $file)
    {
        //uniqid sinh ra mã ngẫu nhiên, tham số đầu tự động nối thêm vào đằng trước mã
        $name = uniqid("menu_") . "." . $file->getClientOriginalExtension();
        //move_uploaded_file() là để lưu file ng dùng đã upload lên server
        // getPathname() là lấy đường dẫn tạm thời (đường dẫn tới file mà ng dùng upload lên server)
        // public_path() là tạo đường dẫn tuyệt đối từ file tới chỗ mình cần lưu file
        move_uploaded_file($file->getPathname(), public_path('images/' . $name));
        return "images/" . $name;
    }
}