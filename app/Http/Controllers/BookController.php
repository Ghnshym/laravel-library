<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            $books = Book::all();
            return view('admin.books.index', ['books' => $books]);
        } else {
            return redirect()->route('login');
        }
    }

    public function storeform()
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            return view('admin.books.store');
        } else {
            return redirect()->route('login');
        }
    }
    public function store(Request $request)
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            $request->validate([
                'title' => 'required',
                'author' => 'required',
                'isbn' => 'required|numeric|unique:books',
                'quantity' => 'required|integer',
                'description' => 'nullable',
            ]);

            Book::create($request->all());

            return redirect()->route('book.storeform')->with('success', 'Book created successfully');
        } else {
            return redirect()->route('login');
        }
    }

    public function updateform($id)
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            $books = Book::find($id);
            if (!$books) {
                return redirect()->route('book.index')->with('error', 'Book not found');
            }

            return view('admin.books.edit', ['books' => $books]);
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

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
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id)
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            $book = Book::find($id);
            $book->delete();

            return redirect()->route('book.index')->with('success', 'Book deleted successfully');
        } else {
            return redirect()->route('login');
        }
    }
}
