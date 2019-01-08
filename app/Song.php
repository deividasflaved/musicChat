<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
  public $timestamps = false;
  protected $fillable = [
      'userid', 'playlist_id', 'url', 'title', 'duration'
  ];
}
