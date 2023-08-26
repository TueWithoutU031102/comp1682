<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    //
    public function create()
    {
        return view("customer.book.create");
    }

    public function store(Request $request, Book $book)
    {
        $data = $request->validate([
            'bookName' => 'required',
            'phonenumber' => 'required',
            'numberofPeople' => 'required',
            'arrivalTime' => 'required',
            'note' => 'nullable',
        ]);
        $book->fill($data)->save();
        return to_route('customer.index')->with('success', 'Booking created successfully!');
    }
}
