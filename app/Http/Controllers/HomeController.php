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
                return view('user.dashboard', ['books' => $books]);
            } elseif ($usertype == 'admin') {
                $books = Book::all();
                return view('admin.adminhome', ['books' => $books]);
            }
        }
        return redirect()->route('login');
    }

    public function bookDetails($id)
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {

            $book = Book::find($id);
            return view('user.bookdetails', ['book' => $book]);
        } else {
            return redirect()->route('login');
        }
    }

    public function notification()
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {

            $user = auth()->user();
            $notifications = Notification::with('user', 'book')
                ->where('user_id', $user->id)
                ->paginate(10);

            return view('user.notification', compact('notifications'));
        } else {
            return redirect()->route('login');
        }
    }


    public function history()
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {

            $user = auth()->user();
            $lendings = Lending::with('user', 'book')
                ->where('user_id', $user->id)
                ->paginate(10);

            return view('user.history', compact('lendings'));
        } else {
            return redirect()->route('login');
        }
    }

    public function cart()
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {
            $user = auth()->user();
            $lendings = Lending::with('user', 'book')
                ->where('user_id', $user->id)
                ->where('payment_status', 'unpaid')
                ->where('payment_type', 'pending')
                ->paginate(10);

            return view('user.cart', compact('lendings'));
        } else {
            return redirect()->route('login');
    }
    }

    public function cash (Request $request, $id) 
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {
            
            $user = auth()->user();
            $lending = Lending::find($id);
        
            if (!$lending) {
                return redirect()->route('user.cart')->with('error', 'Lending record not found.');
            }
            $lending->payment_status = 'unpaid';
            $lending->payment_type = 'cash';
        
            // Save the changes
            $lending->save();
        
            return redirect()->route('user.cart')->with('success', 'Payment status and type updated successfully.');
        }else {
            return redirect()->route('login');
        }
    }

    public function search(Request $request)
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {

            $query = $request->input('query');

            if (!empty($query)) {
                $books = Book::where('title', 'like', '%' . $query . '%')
                    ->orWhere('author', 'like', '%' . $query . '%')
                    ->get();
            } else {
                $books = Book::all();
            }

            return view('user.dashboard', compact('books'));
        } else {
            return redirect()->route('login');
        }
    }

    public function AdminSearch (Request $request)
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            $query = $request->input('query');

            if (!empty($query)) {
                $books = Book::where('title', 'like', '%' . $query . '%')
                    ->orWhere('author', 'like', '%' . $query . '%')
                    ->get();
            } else {
                $books = Book::all();
            }

            return view('admin.adminhome', compact('books'));
        } else {
            return redirect()->route('login');
        }
    }
}
