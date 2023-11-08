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
}
