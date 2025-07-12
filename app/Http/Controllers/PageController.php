<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        $rooms = Room::where('level', 0)->get();
        return view('home', ['rooms' => $rooms]);
    }

    public function room($id, $slug) {
        $room = $room = Room::where('id', $id)->where('slug', $slug)->firstOrFail();
        $subrooms = Room::where('level', $room->level + 1)->get();
        if ($room) {
            return view('room', ['room' => $room, 'subrooms' => $subrooms]);  
        } else {
            return redirect('/');
        }
        
    }

    public function subroom($id, $slug, $subId, $subSlug)
    {
        $room = Room::where('id', $id)->where('slug', $slug)->firstOrFail();
        $subroom = Room::where('id', $subId)->where('slug', $subSlug)->firstOrFail();
        $subrooms = Room::where('upper_room', $subroom->id)->where('level', $subroom->level + 1)->get();


        if ($subroom) {
            return view('room', ['room' => $room, 'subroom' => $subroom, 'subrooms' => $subrooms]);
        } elseif ($room) {
            return redirect('/' . $room->id . '-' . $room->slug);
        } else {
            return redirect('/');
        }
    }
}
