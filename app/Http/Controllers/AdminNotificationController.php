<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lending;
use App\Models\Book;
use App\Models\Notification;
use App\Models\User;

class AdminNotificationController extends Controller
{
    public function notification ()
    {
        $notifications = Notification::with('user', 'book')
                         ->paginate(10);

        return view('admin.notification', compact('notifications'));
    }

    public function history () {

        $lendings = Lending::with('user', 'book')
        ->paginate(10);

        return view('admin.history', compact('lendings'));
    }

    public function returnRequest()
    {
        $lendings = Lending::with('user', 'book')
            ->where('return_status', 'return requested')
            ->paginate(10);
    
        return view('admin.return-request', compact('lendings'));
    }

    public function acceptReturn (Request $request, $id)
    {
        // dd($id);
        $lending = Lending::where('id', $id)->first();
    
        if ($lending) {
            // Update the return_status column to 'return requested'
            $lending->return_status = 'Returned';
            $lending->save();
    
            // Redirect or return a response as needed
            return redirect()->back()->with('success', 'Return accept submitted successfully.');
        } else {
            // Handle the case where the record is not found
            return redirect()->back()->with('error', 'Record not found');
        }
    }
}
