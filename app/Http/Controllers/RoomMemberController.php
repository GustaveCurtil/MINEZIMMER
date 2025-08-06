<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomMemberController extends Controller
{
    public function create(Request $request) 
    {
        $validated = $request->validate([
            'code' => 'required',
        ]);

        $user = Auth::user();

        $room = Room::where('code', $validated['code'])->first();

        if (!$room) {
            return redirect()->back()->withErrors(['code' => 'Room with this code does not exist.']);
        }

        // Check if the user is already a member
        $alreadyMember = RoomMember::where('room_id', $room->id)
            ->where('user_id', $user->id)
            ->exists();
            
        if ($alreadyMember) {
            return redirect('/' . $room->id);
        }

        RoomMember::create([
            'room_id' => $room->id,
            'user_id' => $user->id,
            'role' => 'normal' // default role, you can change this logic
        ]);

        return redirect('/' . $room->id);
    }
}
