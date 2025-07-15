<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subroom extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'level',
        'room_id', 
        'subroom_id',
        'color',
        'bgColor', 
        'icon_path'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function parent()
    {
        return $this->belongsTo(Subroom::class, 'subroom_id');
    }

    public function parents()
    {
        $parents = [];
        $room = $this;

        while ($room->parent) {
            $room = $room->parent;
            array_unshift($parents, $room);  // adds to beginning, so order is from top parent down
        }

        return $parents;  // this is a plain PHP array with numeric keys
    }
}
