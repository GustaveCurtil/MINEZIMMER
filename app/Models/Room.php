<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'open',
        'write_read',
        'slug',
        'code',
        'color',
        'bgColor', 
        'active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function subrooms()
    {
        return $this->hasMany(Subroom::class, 'room_id');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class, 'room_id');
    }
}
