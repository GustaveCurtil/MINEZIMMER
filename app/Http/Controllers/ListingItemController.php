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
            'name' => 'required|string|max:255',
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
            'name' => $validated['name'],
            'description' => $validated['description'],
            'weblink' => $validated['weblink'],
        ]);

        return redirect('/' . $room->id . '/l-' . $validated['listing_id']); 

    }
}
