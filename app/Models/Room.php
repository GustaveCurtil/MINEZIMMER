<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'code',
        'color',
        'bgColor', 
        'icon_path'
    ];

    public function user()
    {
        return $this->belongsTo(Room::class, 'user_id');
    }

    
    public function children()
    {
        return $this->hasMany(Subroom::class, 'upper_room_id');
    }
}
