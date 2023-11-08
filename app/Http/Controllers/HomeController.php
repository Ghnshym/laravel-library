<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Notification;
use App\Models\Lending;

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

    public function notification()
    {
        // Get the authenticated user's notifications with related user and book data
        $user = auth()->user();
        $notifications = Notification::with('user', 'book')
            ->where('user_id', $user->id)
            ->paginate(10);
    
        return view('user.notification', compact('notifications'));
    }
    

    public function history()
    {
        // Get the authenticated user's lending history with related user and book data
        $user = auth()->user();
        $lendings = Lending::with('user', 'book')
            ->where('user_id', $user->id)
            ->paginate(10);
    
        return view('user.history', compact('lendings'));
    }
}
