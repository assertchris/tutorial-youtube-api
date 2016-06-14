<?php

namespace App;

use Eloquent;

class Channel extends Eloquent
{
    /**
     * @var string
     */
    protected $table = "channel";

    /**
     * @var array
     */
    protected $fillable = [
        "youtube_id",
        "youtube_title",
    ];
}
