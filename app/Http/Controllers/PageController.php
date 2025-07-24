<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Subroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function home() 
    {
        $user = Auth::user();
        $rooms = Room::all();
        return view('00_home', ['user' => $user, 'rooms' => $rooms]);
    }

    public function settings() 
    {
        $user = Auth::user();
        return view('01_settings', ['user' => $user]);
    }

    public function room($slug, $subSlug = null) 
    {
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
            return view('10_room', ['user' => $user, 'room' => $room, 'currentRoom' => $currentRoom, 'subrooms' => $subrooms]);  
        } else {
            return redirect('/');
        }
        
    }

    public function cudRoom($slug = null) 
    {
        $user = Auth::user();
        $room = null;

        if ($slug) {
            $room = Room::where('slug', $slug)->firstOrFail(); 
        }

        return view('20_cud_room', [
            'user' => $user,
            'room' => $room,
        ]);
    }

    public function createSubroom($slug, $subSlug = null , $id = null) {
        $user = Auth::user();
        $room = Room::where('slug', $slug)->firstOrFail();
        $subroom = null;
        $update = false;

        if ($id) {
            $subroom = Subroom::find($id); 
        }

        return view('21_cud_subroom', [
            'user' => $user,
            'room' => $room,
            'subroom' => $subroom,
            'update' => $update,
        ]);  

    }

    public function updateSubroom($slug, $subSlug = null , $id = null) 
    {
        $user = Auth::user();
        $room = Room::where('slug', $slug)->firstOrFail();
        $subroom = null;
        $update = true;

        if ($id) {
            $subroom = Subroom::find($id); 
        }

        return view('21_cud_subroom', [
            'user' => $user,
            'room' => $room,
            'subroom' => $subroom,
            'update' => $update,
        ]);  

    }
}
