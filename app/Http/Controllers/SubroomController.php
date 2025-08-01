<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Subroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SubroomController extends Controller
{
    public function create(Request $request)
    {      
        $validated = $request->validate([
            'name' => 'required|string|max:69|min:2',
            'description' => 'nullable|string',
            'room_id' => 'required|integer',
            'subroom_id' => 'nullable|integer',
        ]);

        /* Basis info verzamelen */
        $user = Auth::user();
        $room = Room::where('id', $validated['room_id'])->firstOrFail();
        $subroom = $validated['subroom_id'] ? Subroom::findOrFail($validated['subroom_id']) : null;

        // Generate base name and slug
        $baseName = $validated['name'];
        $name = $baseName;
        $subroomId = $subroom->id ?? null;
        $counter = 2;
        while (Subroom::where('name', $name)
            ->where('room_id', $room->id)
            ->where('subroom_id', $subroomId)
            ->exists()) {
            $name = $baseName . $counter++;
        }        
        
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 2;
        if (!empty($validated['subroom_id'])) {
            while (Subroom::where('slug', $slug)
                ->where('room_id', $room->id)
                ->exists()) {
                $slug = $baseSlug . $counter++;
            }
        } else {
            while (Subroom::where('slug', $slug)
                ->where('room_id', $room->id)
                ->exists()) {
                $slug = $baseSlug . $counter++;
            }
        }

        /* Level bepalen van subroom */
        $level = 1;
        if ($subroom) {
            $level = $subroom->level + 1;
        }

        Subroom::create([
            'user_id' => $user->id,
            'name' => $name,
            'description' => $validated['description'] ?? null,
            'slug' => $slug,
            'level' => $level, 
            'room_id' => $validated['room_id'],
            'subroom_id' => $validated['subroom_id'] ?? null,
        ]);

        if ($subroom) {
            return redirect('/' . $room->slug . '/' . $subroom->slug);  
        } else {
            return redirect('/' . $room->slug);
        }
        
    }

    public function update(Request $request, Subroom $subroom)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:69',
                Rule::unique('subrooms', 'name')
                    ->where(function ($query) use ($subroom) {
                        if ($subroom->subroom_id) {
                            return $query->where('subroom_id', $subroom->subroom_id)
                                        ->where('id', '!=', $subroom->id);
                        } else {
                            return $query->where('room_id', $subroom->room_id)
                                        ->whereNull('subroom_id')
                                        ->where('id', '!=', $subroom->id);
                        }
                    }),
                ],
            'description' => 'nullable|string',
        ]);

        // Generate base slug
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        if (!empty($validated['subroom_id'])) {
            while (Subroom::where('slug', $slug)
                ->exists()) {
                $slug = $baseSlug . $counter++;
            }
        } else {
            while (Subroom::where('slug', $slug)
                ->exists()) {
                $slug = $baseSlug . $counter++;
            }
        }

        $subroom->name = $validated['name'];
        $subroom->description = $validated['description'] ?? null;
        $subroom->slug = $slug;

        $subroom->save();

        // Fetch room slug for redirect
        $room = Room::findOrFail($subroom->room_id);

        return redirect('/' . $room->slug . '/' . $subroom->slug);
    }
}
