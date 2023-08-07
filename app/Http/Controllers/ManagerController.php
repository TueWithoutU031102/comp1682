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
        $books = Book::all();
        return view("/Manager/index", ['books' => $books]);
    }

    public function menu()
    {
        $menus = Menu::all();
        return view("/Manager/menu/indexMenu", ['menus' => $menus]);
    }
    public function createFormMenu()
    {
        $listTypes = Type::all();
        $listStatus = StatusMenu::all();
        return view("/Manager/menu/menuForm", ['listTypes' => $listTypes, 'listStatus' => $listStatus]);
    }
    public function createMenu(formMenu $request)
    {
        $menu = new Menu($request->all());
        $menu->image = $this->saveImage($request->file('image'));
        $menu->save();
        return redirect()->route('indexMenu')->with('success', 'Dish created successfully!');
    }

    public function detailMenu($id)
    {
        $dish = Menu::find($id);
        $typeName = Type::find(Menu::find($id)->type_id);
        return view("/Manager/menu/detailMenu", ['dish' => $dish, 'typeName' => $typeName]);
    }
    public function editFormMenu($id)
    {
        $menu = Menu::find($id);
        $listTypes = Type::all();
        $listStatus = StatusMenu::all();
        return view("Manager/menu/editMenu", ["menu" => $menu, "listTypes" => $listTypes, "listStatus" => $listStatus]);
    }
    public function editMenu(editMenu $request)
    {
        $input = $request->all();
        if ($request->hasFile('image')) {
            Menu::find($request->id)->removeImage();
            $input['image'] = $this->saveImage($request->file('image'));
        } else
            $input['image'] = Menu::find($input['id'])->image;

        Menu::find($request->id)->update($input);
        return redirect()->route('indexMenu')->with('success', 'Dish edited successfully!');
    }
    public function deleteMenu(Menu $menu)
    {
        $menu->removeImage();
        $menu->delete();
        return redirect()->route('indexMenu')->with('success', 'Dish deleted successfully!');
    }
    public function type()
    {
        $types = Type::all();
        return view("/Manager/type/indexType", ['types' => $types]);
    }
    public function createFormType()
    {
        return view("/Manager/type/typeForm");
    }
    public function createType(formType $request)
    {
        $type = new Type($request->all());
        $type->save();
        return redirect()->route('indexType')->with('success', 'Type created successfully!');
    }
    public function editFormType($id)
    {
        $type = Type::find($id);
        return view("Manager/type/editType", ["type" => $type]);
    }
    public function editType(editType $request)
    {
        $input = $request->all();
        Type::find($request->id)->update($input);
        return redirect()->route('indexType')->with('success', 'Type edited successfully!');
    }
    public function deleteType(Type $type)
    {
        $type->delete();
        return redirect('/manager/type/indexType')->with('success', 'Type deleted successfully');
    }
    public function booking()
    {
        $booking = Book::all();
        return view("/Manager/booking/indexBook", ['booking' => $booking]);
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
