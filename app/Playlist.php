<?php

namespace App;

use Eloquent;

class Playlist extends Eloquent
{
    /**
     * @var string
     */
    protected $table = "playlist";

    /**
     * @var array
     */
    protected $fillable = [
        "youtube_id",
        "youtube_title",
    ];
}
