<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notifications;
use illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function notifications(){
        if (Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();
            $notifications = Notifications::where('sent_to', $user->id)
                ->latest() 
                ->get()
                ->map(function($notify){
                    // Modify or extract specific attributes as needed
                    return [
                        'id' => $notify->id,
                        'notifications' => $notify->notification,
                        'created_at' => $notify->created_at,
                    ];
                });
    
            if ($notifications->isEmpty()) {
                return response()->json(['message' => 'No notifications found.'], 404);
            }
    
            return response()->json(['notifications' => $notifications], 200);
        }
        
        return response()->json(['message' => 'Unauthorized user.'], 401);
    }
    
    
}
