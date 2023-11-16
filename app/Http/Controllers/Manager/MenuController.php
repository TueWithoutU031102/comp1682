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
    //
    public function event()
    {
        $types = Type::all();
        $menus = Menu::all();
        return response()->json([
            'menus' => $menus,
            'types' => $types,
        ]);
    }
    public function index()
    {
        $menus = Menu::all();
        $types = Type::all();
        return view("manager.menu.index", ['menus' => $menus, 'types' => $types]);
    }
    public function create()
    {
        $listTypes = Type::all();
        $listStatus = StatusMenu::cases();
        return view("manager.menu.create", ['listTypes' => $listTypes, 'listStatus' => $listStatus]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required',
            'status' => ['required', new Enum(StatusMenu::class)],
        ]);

        $imagePath = $this->saveImage($request->file('image'));
        Menu::create(array_merge($data, ['image' => $imagePath]));
        return '<script>
        window.parent.postMessage("menu created", "*")
        </script>';
    }

    public function show(Menu $menu)
    {
        return view("manager.menu.show", ['menu' => $menu]);
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
            'price' => 'required',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $menu->removeImage();
            $data['image'] = $this->saveImage($request->file('image'));
        } else
            $data['image'] = $menu->image;
        $menu->fill($data)->save();
        return '<script>
        window.parent.postMessage("menu edited", "*")
        </script>';
    }
    public function destroy(Menu $menu)
    {
        $menu->removeImage();
        $menu->delete();
        return '<script>
        window.parent.postMessage("menu deleted", "*")
        </script>';
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
