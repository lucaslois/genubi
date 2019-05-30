<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function click($id) {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->viewed = true;
        $notification->save();

        return redirect()->to($notification->link);
    }
}
