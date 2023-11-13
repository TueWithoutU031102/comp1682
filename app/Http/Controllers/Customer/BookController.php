<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            'phonenumber' => 'required|digits:10|starts_with:0',
            'numberofPeople' => 'required|numeric|min:1',
            'arrivalTime' => ['required', 'after:' . now()->addHour()->toDateTimeString()],
            'note' => 'nullable',
        ], [
            'phonenumber.digits' => 'Phone number must be numeric and 10 characters long',
            'numberofPeople.numeric' => 'Please enter a number of people',
            'phonenumber.starts_with' => 'Phone number must start with 0',
            'arrivalTime.after' => 'Please reserve a table 1 hour in advance',
        ]);
        $book->fill($data)->save();
        return to_route('customer.book.create')->with('success', 'Booking created successfully!');
    }
}