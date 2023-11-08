<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Lending;

class LendingController extends Controller
{
    public function lendingform($id) {
        $book = Book::find($id);
        return view('user.lendingOrderPage', ['book' => $book]);
    }

    public function lendingbook(Request $request, $id) {
        $rules = [
            'due_date' => 'required|date|after_or_equal:' . date('Y-m-d'),
            'returned_at' => 'required|date|after_or_equal:due_date',
        ];
        $request->validate($rules);
        $user = Auth::user();
    
        // Find the book by its ID
        $book = Book::findOrFail($id);
    
        // Check if the book is available
        if ($book->quantity <= 0) {
            return redirect()->back()->with('error', 'Sorry, this book is out of stock.');
        }
    
        // Decrease the book's quantity by one
        $book->decrement('quantity');
    
        // Create a new Lending instance
        $lending = new Lending();
        $lending->user_id = $user->id;
        $lending->book_id = $id;
        $lending->due_date = $request->input('due_date');
        $lending->returned_at = $request->input('returned_at');
    
        $lending->return_status = 'pending';
        $lending->late_fine = 0;
    
        $lending->save();
    
        return redirect()->back()->with('success', 'Book lending successfully');
    }
    

    public function return(Request $request, $id)
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Find the Lending record that matches the user_id and the provided $id
        $lending = Lending::where('user_id', $user->id)->where('id', $id)->first();
    
        if ($lending) {
            // Update the return_status column to 'return requested'
            $lending->return_status = 'return requested';
            $lending->save();
    
            // Redirect or return a response as needed
            return redirect()->back()->with('success', 'Return request submitted successfully.');
        } else {
            // Handle the case where the record is not found
            return redirect()->back()->with('error', 'Record not found or you are not authorized.');
        }
    }
}
