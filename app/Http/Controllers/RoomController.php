<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2',
        ]);

        $user = Auth::user();

        Room::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'slug' => Str::slug('"' . $validated['name'] . '"'),
        ]);

        return redirect()->back();
    }

    public function customizeColor(Request $request) 
    {
        $room = Room::where('id', $request->id)->firstOrFail();

        if ($room) {
            $room->color = $request->color;
            $room->bgColor = $request->bgColor;
            $room->update();        
        }

        return redirect()->back();
    }

    public function changeIcon(Request $request) 
    {
        $room = Room::where('id', $request->id)->firstOrFail();

        if ($room) {
            $room->icon_path = $request->icon_path;
            $room->update();        
        }

        return redirect()->back();
    }
}
