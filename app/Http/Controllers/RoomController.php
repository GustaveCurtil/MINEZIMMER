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
}
