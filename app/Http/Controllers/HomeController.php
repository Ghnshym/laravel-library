<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $usertype = $user->usertype;
    
            if ($usertype == 'user') {
                $books = Book::all();
                return view('user.dashboard', ['books' => $books]);;
            } elseif ($usertype == 'admin') {
                return view('admin.adminhome');
            }
        }
        return redirect()->route('login');
    }

    public function bookDetails($id) {
        $book = Book::find($id);
        return view('user.bookdetails', ['book' => $book]);
    }
}
