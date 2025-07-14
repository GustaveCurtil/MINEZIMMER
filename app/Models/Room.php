<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'code',
        'color',
        'bgColor', 
        'icon_path'
    ];

    public function parent()
    {
        return $this->belongsTo(Room::class, 'upper_room');
    }

    public function allParents()
    {
        $parents = [];
        $room = $this;

        while ($room->parent) {
            $room = $room->parent;
            array_unshift($parents, $room);  // adds to beginning, so order is from top parent down
        }

        return $parents;  // this is a plain PHP array with numeric keys
    }
    
    public function children()
    {
        return $this->hasMany(Room::class, 'upper_room');
    }
}
