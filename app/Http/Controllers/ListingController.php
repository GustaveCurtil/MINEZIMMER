<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Listing;
use App\Models\Subroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'subroom_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        /* Basis info verzamelen */
        $user = Auth::user();
        $room = Room::where('id', $validated['room_id'])->firstOrFail();
        $subroom = $validated['subroom_id'] ? Subroom::findOrFail($validated['subroom_id']) : null;

        // Generate base slug
        $baseName = $validated['name'];
        $name = $baseName;
        $subroomId = $subroom->id ?? null;
        $counter = 2;
        while (Listing::where('name', $name)
            ->where('room_id', $room->id)
            ->where('subroom_id', $subroomId)
            ->exists()) {
            $name = $baseName . $counter++;
        }

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 2;

        while (Listing::where('slug', $slug)
            ->where('subroom_id', $subroomId)
            ->where('room_id', $room->id)
            ->exists()) {
            $slug = $baseSlug . $counter++;
        }


        $listing = Listing::create([
            'room_id' => $request->room_id,
            'subroom_id' => $request->subroom_id,
            'user_id' => $user->id,
            'name' => $name,
            'slug' => $slug,
            'description' => $request->description,
        ]);

        return redirect()->route('listings.show', $listing);
    }
}
