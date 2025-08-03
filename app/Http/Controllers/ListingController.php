<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Listing;
use App\Models\Subroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'subroom_id' => 'nullable|exists:subrooms,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        /* Basis info verzamelen */
        $user = Auth::user();
        $room = Room::find($validated['room_id']);
        $subroom = null;
        if (!empty($validated['subroom_id'])) {
            $subroom = $room->subrooms()->findOrFail($validated['subroom_id']);
        }

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


        Listing::create([
            'room_id' => $request->room_id,
            'subroom_id' => $request->subroom_id,
            'user_id' => $user->id,
            'name' => $name,
            'description' => $request->description,
        ]);

        if ($subroom) {
            return redirect('/' . $room->id . '/s-' . $subroom->id); 
        } else {
            return redirect('/' . $room->id);
        }
    }

    public function update(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:69', Rule::unique('listings', 'name')->ignore($listing->id)],
            'description' => 'nullable|string',
        ]);

        $listing->name = $validated['name'];
        $listing->description = $validated['description'] ?? null;

        $listing->save();

        return redirect('/' . $listing->room_id . '/l-' . $listing->id);

    }
}
