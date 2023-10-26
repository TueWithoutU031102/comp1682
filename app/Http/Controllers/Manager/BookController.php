<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    //
    public function index()
    {
        $books = Book::all();
        return view("manager.book.index", ['books' => $books]);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return to_route('manager.book.index')->with('success', 'Deleted successfully!');
    }
}
