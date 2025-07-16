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
        $iconFiles = File::allFiles(public_path('icons'));
        return view('home', ['user' => $user, 'rooms' => $rooms, 'iconFiles' => $iconFiles]);
    }

    public function room($id, $slug) {
        $user = Auth::user();
        $actualRoom = Room::where('id', $id)->where('slug', $slug)->firstOrFail();
        $children = Subroom::where('room_id', $actualRoom->id)->where('level', 1)->get();
        $iconFiles = File::allFiles(public_path('icons'));
        if ($actualRoom) {
            return view('room', ['user' => $user, 'actualRoom' => $actualRoom, 'actualSubroom' => $actualRoom, 'children' => $children, 'iconFiles' => $iconFiles]);  
        } else {
            return redirect('/');
        }
        
    }

    public function subroom($id, $slug, $subId, $subSlug)
    {
        $user = Auth::user();
        $actualRoom = Room::where('id', $id)->where('slug', $slug)->firstOrFail();
        $actualSubroom = Subroom::where('id', $subId)->where('slug', $subSlug)->firstOrFail();
        $children = Subroom::where('room_id', $actualRoom->id)->where('level', $actualSubroom->level + 1)->get();
        $iconFiles = File::allFiles(public_path('icons'));
        if ($actualSubroom) {
            return view('room', ['user' => $user, 'actualRoom' => $actualRoom, 'actualSubroom' => $actualSubroom, 'children' => $children, 'iconFiles' => $iconFiles]);  
        } else {
            return redirect('/');
        }
    }
}
