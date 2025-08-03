<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Listing;
use App\Models\Subroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function home() 
    {
        $user = Auth::user();
        $rooms = Room::orderBy('name', 'asc')->get();
        return view('00_home', ['user' => $user, 'rooms' => $rooms]);
    }

    public function settings() 
    {
        $user = Auth::user();
        return view('01_settings', ['user' => $user]);
    }

    public function room($roomId, $subroomId = null) 
    {
        $user = Auth::user();
        $room = Room::find($roomId);

        if ($subroomId) {
            $currentRoom = Subroom::find($subroomId);
            $currentLevel = $currentRoom->level;
            $subroomId = $currentRoom->id;
        } else {
            $currentRoom = $room;
            $currentLevel = 0;
            $subroomId = null;
        }
        
        $subrooms = Subroom::where('room_id', $roomId)->where('subroom_id', $subroomId)->where('level', $currentLevel + 1)->orderBy('name')->get();
        $listings = Listing::where('room_id', $roomId)->where('subroom_id', $subroomId)->orderBy('name')->get();
        
        // foreach ($subrooms as $subroom) {
        //     $subroom->type = "room";
        // }

        if ($room) {
            return view('10_room', ['user' => $user, 'room' => $room, 'currentRoom' => $currentRoom, 'subrooms' => $subrooms, 'listings' => $listings]);  
        } else {
            return redirect('/');
        }
        
    }

    public function listing($roomId, $listingId) 
    {
        $user = Auth::user();
        $room = Room::find($roomId);
        $listing = Listing::find($listingId);
        $listingItems = $listing->items;

        if ($room) {
            return view('11_listing', ['user' => $user, 'listing' => $listing, 'listingItems' => $listingItems]);  
        } else {
            return redirect('/');
        }
        
    }

    public function atelier($roomId, $subroomId = null)
    {
        $user = Auth::user();
        $room = Room::find($roomId);
        $subroom = Subroom::find($subroomId);
        return view('20_atelier', ['user' => $user, 'room' => $room, 'subroom' => $subroom]);
    }

    public function createRoom() 
    {
        $user = Auth::user();
        $room = null;
        $update = false;

        return view('21_cud_room', ['user' => $user, 'room' => $room, 'update' => $update]);
    }

    public function editRoom($roomId) 
    {
        $user = Auth::user();
        $room = Room::find($roomId);
        $update = true;

        if ($room && $room->user->id === $user->id) {
            return view('21_cud_room', ['user' => $user, 'room' => $room, 'update' => $update]);
        } else {
            return redirect()->back();
        }    
    }

    public function createSubroom($roomId, $subroomId = null) {
        $user = Auth::user();
        $room = Room::find($roomId);;
        $subroom = Subroom::find($subroomId);
        $update = false;

        return view('22_cud_subroom', [
            'user' => $user,
            'room' => $room,
            'subroom' => $subroom,
            'update' => $update,
        ]);  

    }

    public function editSubroom($roomId, $subroomId) 
    {
        $user = Auth::user();
        $room = Room::find($roomId);
        $update = true;
        $subroom = Subroom::find($subroomId); 


        return view('22_cud_subroom', [
            'user' => $user,
            'room' => $room,
            'subroom' => $subroom,
            'update' => $update,
        ]);  

    }

    public function createListing($roomId, $subroomId = null) {
        $user = Auth::user();
        $room = Room::find($roomId);;
        $subroom = Subroom::find($subroomId);
        $update = false;

        return view('23_cud_listing', [
            'user' => $user,
            'room' => $room,
            'subroom' => $subroom,
            'update' => $update,
        ]);  

    }

    public function createListingItem($roomId, $listingId) {
        $user = Auth::user();
        $room = Room::find($roomId);;
        $listing = Listing::find($listingId);
        $update = false;

        return view('24_create_listing_item', [
            'user' => $user,
            'room' => $room,
            'listing' => $listing,
            'update' => $update,
        ]);  

    }
}
