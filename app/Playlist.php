<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'userid', 'playlist_name', 'playlist_info'
    ];
}
