<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:69|unique:rooms,name',
            'description' => 'nullable|string',
            'open' => 'boolean',
            'write_read' => 'boolean'
        ]);

        /* Basis info verzamelen */
        $user = Auth::user();

        /* makes sure the slugs are unique as well */
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Room::where('slug', $slug)->exists()) {
            $slug = $baseSlug . $counter;
            $counter++;
        }

        Room::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
            'slug' => Str::slug($validated['name']),
            'open' => $validated['open'],
            'write_read' => $validated['write_read']
        ]);

        return redirect('/');
    }


    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:69', Rule::unique('rooms', 'name')->ignore($room->id)],
            'description' => 'nullable|string',
            'open' => 'boolean',
            'write_read' => 'boolean'
        ]);

        /* makes sure the slugs are unique as well */
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Room::where('slug', $slug)->exists()) {
            $slug = $baseSlug . $counter;
            $counter++;
        }
        $validated['slug'] = $slug;

        $room->update($validated);

        return redirect('/' . $room->slug);
    }
}
