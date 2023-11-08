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
    
        // Create a new Lending instance
        $lending = new Lending();
        $lending->user_id = $user->id;
        $lending->book_id = $id;
        $lending->due_date = $request->input('due_date');
        $lending->returned_at = $request->input('returned_at');
    
        $lending->return_status = 'pending';
        $lending->late_fine = 0;
    
        $lending->save();
    
        return redirect()->back()->with('success', "Book lending successfully");
    }
}
