<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', ['books' => $books]);
    }
    
    public function storeform () {
        return view('admin.books.store');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|numeric|unique:books',
            'quantity' => 'required|integer',
            'description' => 'nullable',
        ]);
    
        Book::create($request->all());

        return redirect()->route('book.storeform')->with('success', 'Book created successfully');
    }

    public function updateform($id)
    {
    $books = Book::find($id);
    if (!$books) {
        return redirect()->route('book.index')->with('error', 'Book not found');
    }

    return view('admin.books.edit', ['books' => $books]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $id,
            'quantity' => 'required|integer',
            'description' => 'nullable',
        ]);

        $book = Book::find($id);
        $book->update($request->all());

        return redirect()->route('book.index')->with('success', 'Book updated successfully');
    }

    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Book deleted successfully');
    }

    
}
