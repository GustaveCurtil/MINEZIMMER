<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingItemController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'weblink' => 'nullable|url',
        ]);

        /* Basis info verzamelen */
        $user = Auth::user();
        $listing = Listing::with('subroom.room')->findOrFail($validated['listing_id']);
        $room = $listing->room;

        ListingItem::create([
            'listing_id' => $validated['listing_id'],
            'user_id' => $user->id,
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'weblink' => $validated['weblink'] ?? null,
        ]);

        return redirect('/' . $room->id . '/l-' . $validated['listing_id']); 

    }
}
