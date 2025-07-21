<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Subroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function home() {
        $user = Auth::user();
        $rooms = Room::all();
        return view('home', ['user' => $user, 'rooms' => $rooms]);
    }

    public function settings() {
        $user = Auth::user();
        return view('settings', ['user' => $user]);
    }

    public function workbenchRoom() {
        $user = Auth::user();
        return view('workbench_room', ['user' => $user]);
    }

    public function workbench() {
        $user = Auth::user();
        return view('workbench', ['user' => $user]);
    }

    public function enterRoom($slug, $subSlug = null) {
        $user = Auth::user();
        $room = Room::where('slug', $slug)->firstOrFail();

        if ($subSlug) {
            $currentRoom = Subroom::where('slug', $subSlug)->firstOrFail();
            $currentLevel = $currentRoom->level;
            $subroomId = $currentRoom->id;
        } else {
            $currentRoom = $room;
            $currentLevel = 0;
            $subroomId = null;
        }
        
        $subrooms = Subroom::where('room_id', $room->id)->where('subroom_id', $subroomId)->where('level', $currentLevel + 1)->get();

        if ($room) {
            return view('room', ['user' => $user, 'room' => $room, 'currentRoom' => $currentRoom, 'subrooms' => $subrooms]);  
        } else {
            return redirect('/');
        }
        
    }

    // public function subroom($id, $slug, $subId, $subSlug)
    // {
    //     $user = Auth::user();
    //     $actualRoom = Room::where('id', $id)->where('slug', $slug)->firstOrFail();
    //     $actualSubroom = Subroom::where('id', $subId)->where('slug', $subSlug)->firstOrFail();
    //     $children = Subroom::where('room_id', $actualRoom->id)->where('level', $actualSubroom->level + 1)->get();
    //     $iconFiles = File::allFiles(public_path('icons'));
    //     if ($actualSubroom) {
    //         return view('room', ['user' => $user, 'actualRoom' => $actualRoom, 'actualSubroom' => $actualSubroom, 'children' => $children, 'iconFiles' => $iconFiles]);  
    //     } else {
    //         return redirect('/');
    //     }
    // }
}
