<?php

namespace App;

use Eloquent;

class Video extends Eloquent
{
    /**
     * @var string
     */
    protected $table = "video";

    /**
     * @var array
     */
    protected $fillable = [
        "youtube_id",
        "youtube_title",
    ];
}
