<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['desk_capacity', 'size'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function desks() {
        return $this->hasMany('App\Models\Desk');
    }
}
