<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{

    protected $fillable = [
        'room_id',
        'subroom_id',
        'user_id',
        'name',
        'description',
        'slug',
    ];


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function subroom()
    {
        return $this->belongsTo(Subroom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(ListingItem::class);
    }
    
}
