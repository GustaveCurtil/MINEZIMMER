<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function home() {
        $rooms = Room::all();
        $iconFiles = File::allFiles(public_path('icons'));
        return view('home', ['rooms' => $rooms, 'iconFiles' => $iconFiles]);
    }

    public function room($id, $slug) {
        $room = $room = Room::where('id', $id)->where('slug', $slug)->firstOrFail();
        $subrooms = Room::where('upper_room', $room->id)->where('level', $room->level + 1)->get();
        $iconFiles = File::allFiles(public_path('icons'));
        if ($room) {
            return view('room', ['room' => $room, 'subrooms' => $subrooms, 'iconFiles' => $iconFiles]);  
        } else {
            return redirect('/');
        }
        
    }

    public function subroom($id, $slug, $subId, $subSlug)
    {
        $room = Room::where('id', $id)->where('slug', $slug)->firstOrFail();
        $subroom = Room::where('id', $subId)->where('slug', $subSlug)->firstOrFail();
        $subrooms = Room::where('upper_room', $subroom->id)->where('level', $subroom->level + 1)->get();
        $iconFiles = File::allFiles(public_path('icons'));

        if ($subroom) {
            return view('room', ['room' => $room, 'subroom' => $subroom, 'subrooms' => $subrooms, 'iconFiles' => $iconFiles]);
        } elseif ($room) {
            return redirect('/' . $room->id . '-' . $room->slug);
        } else {
            return redirect('/');
        }
    }
}
