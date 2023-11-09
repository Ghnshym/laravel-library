<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Lending;

class LendingController extends Controller
{
    public function lendingform($id)
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {

            $book = Book::find($id);
            return view('user.lendingOrderPage', ['book' => $book]);
        } else {
            return redirect()->route('login');
        }
    }

    public function lendingbook(Request $request, $id)
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {

            $rules = [
                'due_date' => 'required|date|after_or_equal:' . date('Y-m-d'),
                'returned_at' => 'required|date|after_or_equal:due_date',
            ];
            $request->validate($rules);
            $user = Auth::user();

            $book = Book::findOrFail($id);

            if ($book->quantity <= 0) {
                return redirect()->back()->with('error', 'Sorry, this book is out of stock.');
            }

            $book->decrement('quantity');

            $lending = new Lending();
            $lending->user_id = $user->id;
            $lending->book_id = $id;
            $lending->due_date = $request->input('due_date');
            $lending->returned_at = $request->input('returned_at');
            
            $lending->payment_status = 'unpaid';
            $lending->payment_type = 'cash';
            $lending->return_status = 'pending';
            $lending->late_fine = 0;

            $lending->save();

            return redirect()->back()->with('success', 'Book lending successfully');
        } else {
            return redirect()->route('login');
        }
    }


    public function return(Request $request, $id)
    {
        if (auth()->check() && auth()->user()->usertype == 'user') {
            $user = auth()->user();

            $lending = Lending::where('user_id', $user->id)->where('id', $id)->first();

            if ($lending) {
                $lending->return_status = 'return requested';
                $lending->save();

                return redirect()->back()->with('success', 'Return request submitted successfully.');
            } else {
                return redirect()->back()->with('error', 'Record not found or you are not authorized.');
            }
        } else {
            return redirect()->route('login');
        }
    }
}
