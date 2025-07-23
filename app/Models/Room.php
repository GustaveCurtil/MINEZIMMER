<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
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

    
    public function children()
    {
        return $this->hasMany(Subroom::class, 'upper_room_id');
    }
}
