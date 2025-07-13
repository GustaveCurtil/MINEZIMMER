<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2',
            'level' => 'required|integer',
            'upper_room' => 'nullable'
        ]);

        $room = Room::create([
            'name' => $validated['name'],
            'slug' => Str::slug('"' . $validated['name'] . '"'),
            'level' => $validated['level'],
            'upper_room' => $validated['upper_room']
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
