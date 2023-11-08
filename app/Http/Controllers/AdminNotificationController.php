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
        if (auth()->check() && auth()->user()->usertype == 'admin') {
        
            $notifications = Notification::with('user', 'book')
                            ->paginate(10);
            return view('admin.notification', compact('notifications'));
        } else {
            return redirect()->route('login');
        }
    }

    public function history () 
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            $lendings = Lending::with('user', 'book')
            ->paginate(10);

            return view('admin.history', compact('lendings'));
        } else {
             return  redirect()->route('login');
        }
    }

    public function returnRequest()
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            $lendings = Lending::with('user', 'book')
                ->where('return_status', 'return requested')
                ->paginate(10);
        
            return view('admin.return-request', compact('lendings'));
        } else {
            return redirect()->route('login');
        }
    }

    public function acceptReturn (Request $request, $id)
    {
        if (auth()->check() && auth()->user()->usertype == 'admin') {

            $lending = Lending::where('id', $id)->first();
        
            if ($lending) {
                $lending->return_status = 'Returned';
                $lending->save();
        
                return redirect()->back()->with('success', 'Return accept submitted successfully.');
            } else {
                return redirect()->back()->with('error', 'Record not found');
            }
        } else {
           return redirect()->route('login'); 
        }
    }
}
