<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desk extends Model
{
    use HasFactory;

    protected $fillable = ['is_taken', 'price', 'size', 'position'];

    public function room() {
        return $this->belongsTo('App\Room');
    }
}
