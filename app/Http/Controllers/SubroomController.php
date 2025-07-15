<?php

namespace App\Http\Controllers;

use App\Models\Subroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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

        Subroom::create([
            'name' => $validated['name'],
            'slug' => Str::slug('"' . $validated['name'] . '"'),
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

    public function changeIcon(Request $request) 
    {
        $subroom = Subroom::where('id', $request->id)->firstOrFail();

        if ($subroom) {
            $subroom->icon_path = $request->icon_path;
            $subroom->update();        
        }

        return redirect()->back();
    }
}
