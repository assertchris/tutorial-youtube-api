<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use App\Http\Requests;

class PageController extends Controller
{
    public function index()
    {
        return view("page/index");
    }

    public function dashboard()
    {
        $channels = Channel::all();

        return view("page/dashboard", [
            "channels" => $channels,
        ]);
    }
}
