<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * @var string
     */
    protected $table = "user";

    /**
     * @var array
     */
    protected $fillable = [
        "youtube_id",
        "youtube_token",
    ];

    /**
     * @var array
     */
    protected $hidden = [
        "youtube_token",
    ];
}
