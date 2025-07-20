<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Subroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubroomController extends Controller
{
    public function create(Request $request)
    {      
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2',
            'level' => 'required|integer', 
            'room_id' => 'required|integer',
            'subroom_id' => 'nullable|integer',
        ]);

        $user = Auth::user();

        // Generate base slug
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $suffix = 1;

        // Check for existing slugs, and append a short random code if needed
        while (Subroom::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . strtolower(Str::random(4)); // e.g. "control-room-x8f3"
        }

        Subroom::create([
            'name' => $validated['name'],
            'user_id' => $user->id,
            'slug' => $slug,
            'level' => $validated['level'], 
            'room_id' => $validated['room_id'],
            'subroom_id' => $validated['subroom_id'],
        ]);

        return redirect()->back();
    }

    public function customizeColor(Request $request) 
    {
        $subroom = Subroom::where('id', $request->id)->firstOrFail();

        if ($subroom) {
            $subroom->color = $request->color;
            $subroom->bgColor = $request->bgColor;
            $subroom->update();        
        }

        return redirect()->back();
    }

    public function description(Request $request)
    {      
        $validated = $request->validate([
            'description' => 'nullable|string|min:2',
            'room_id' => 'required|integer',
            'subroom_id' => 'nullable|integer',
        ]);

        $subroom = Subroom::where('id', $request->subroom_id)->firstOrFail();

        if ($subroom) {
            $subroom->description = $validated['description'];
            $subroom->update(); 
        } else {
            $room = Room::where('id', $request->room->id)->firstOrFail();
            $room->description = $validated['description'];
            $room->update(); 
        }
        return redirect()->back();
    }
}
