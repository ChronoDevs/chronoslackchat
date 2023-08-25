<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Channel;

class HomeController extends Controller
{
    public function index()
    {
        $channels = Channel::list();

        return view('pages.home.index', compact('channels'));
    }
}
