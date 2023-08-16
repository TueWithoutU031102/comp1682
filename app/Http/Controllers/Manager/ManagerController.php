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
}
